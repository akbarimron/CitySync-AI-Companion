<?php

namespace App\Http\Controllers\Akbar;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class AiMonitorController extends Controller
{
    public function index(): View
    {
        return view('akbar.ai-monitor', [
            'result' => null,
            'outputVideoUrl' => null,
            'sourceUsed' => null,
        ]);
    }

    public function analyze(Request $request)
    {
        // Extensive debug logging
        $debugInfo = [
            'timestamp' => now()->toIso8601String(),
            'method' => $request->getMethod(),
            'content_type' => $request->header('content-type'),
            'content_length' => $request->header('content-length'),
            'has_file_video_file' => $request->hasFile('video_file'),
            'all_files_keys' => array_keys($request->allFiles()),
            'all_input_keys' => array_keys($request->all()),
            'all_files_raw' => $request->allFiles(),
        ];
        
        \Log::info('=== ANALYZE REQUEST DEBUG ===', $debugInfo);
        
        $wantsJson = $request->wantsJson() || $request->has('json');
        
        // Get the raw files array
        $files = $request->allFiles();
        \Log::info('Raw files array:', ['files' => $files]);
        
        // Try different ways to get the file
        $videoFile = null;
        if ($request->hasFile('video_file')) {
            $videoFile = $request->file('video_file');
            \Log::info('File found via hasFile - video_file');
        } elseif (isset($files['video_file'])) {
            $videoFile = $files['video_file'];
            \Log::info('File found in allFiles array - video_file');
        }
        
        // If we have a file, process it
        if ($videoFile) {
            \Log::info('Processing uploaded file', [
                'original_name' => $videoFile->getClientOriginalName() ?? 'unknown',
                'mime' => $videoFile->getClientMimeType() ?? 'unknown',
                'size' => $videoFile->getSize() ?? 0,
                'is_valid' => $videoFile->isValid() ?? false,
            ]);
            
            if (!$videoFile->isValid()) {
                $error = $videoFile->getErrorMessage();
                \Log::error('File invalid', ['error' => $error]);
                return $wantsJson 
                    ? response()->json(['success' => false, 'message' => 'File upload invalid: ' . $error], 400)
                    : back()->withErrors(['ai' => 'File upload invalid: ' . $error])->withInput();
            }

            // Save file to input directory
            $inputDir = storage_path('app/akbar/input');
            File::ensureDirectoryExists($inputDir, 0755, true);
            
            // Get original extension
            $ext = $videoFile->getClientOriginalExtension();
            $filename = Str::uuid() . '.' . $ext;
            $fullPath = $inputDir . DIRECTORY_SEPARATOR . $filename;
            
            // Move file to storage directly
            $videoFile->move($inputDir, $filename);
            
            // Verify file exists
            if (!file_exists($fullPath)) {
                \Log::error('File move failed', ['expected_path' => $fullPath]);
                return $wantsJson
                    ? response()->json(['success' => false, 'message' => 'File gagal disimpan ke storage.'], 500)
                    : back()->withErrors(['ai' => 'File gagal disimpan ke storage.'])->withInput();
            }
            
            \Log::info('File saved successfully', [
                'path' => $fullPath,
                'size' => filesize($fullPath),
                'exists' => file_exists($fullPath),
            ]);
            
            return $this->executeAnalysis($fullPath, $wantsJson);
        }

        // Check for video source (URL/path/webcam)
        $videoSource = trim((string) ($request->input('video_source') ?? ''));
        if (!empty($videoSource)) {
            \Log::info('Using video source', ['source' => $videoSource]);
            return $this->executeAnalysis($videoSource, $wantsJson);
        }

        // No file and no source
        \Log::warning('No file or source provided', $debugInfo);
        return $wantsJson
            ? response()->json(['success' => false, 'message' => 'Upload video atau isi URL/path video source.'], 400)
            : back()->withErrors(['ai' => 'Upload video atau isi URL/path video source.'])->withInput();
    }

    private function executeAnalysis(string $source, bool $wantsJson = false)
    {
        // Use wrapper script instead of direct script
        $scriptPath = base_path('scripts/akbar/app_vr_ai_wrapper.py');
        if (!File::exists($scriptPath)) {
            // Fallback to original if wrapper doesn't exist
            $scriptPath = base_path('scripts/akbar/app_vr_ai.py');
        }
        
        if (!File::exists($scriptPath)) {
            return $wantsJson
                ? response()->json(['success' => false, 'message' => 'Script AI tidak ditemukan.'], 500)
                : back()->withErrors(['ai' => 'Script AI tidak ditemukan.'])->withInput();
        }

        $runId = (string) Str::uuid();
        $outputDir = storage_path('app/public/akbar/ai-output');
        File::ensureDirectoryExists($outputDir);

        $outputJson = $outputDir.'/'.$runId.'.json';
        $outputVideo = $outputDir.'/'.$runId.'.mp4';

        $pythonBin = config('ai.python_bin', 'python');
        
        \Log::info('Starting AI analysis', [
            'python_bin' => $pythonBin,
            'source' => $source,
            'script' => $scriptPath,
            'output_json' => $outputJson,
        ]);

        // Set environment variables to fix Windows socket issues
        $env = [
            'KMP_DUPLICATE_LIB_OK' => 'True',
            'PYTHONIOENCODING' => 'utf-8',
            'PYTHONUNBUFFERED' => '1',
        ];
        
        // Merge with existing environment
        foreach (getenv() as $key => $value) {
            if (!isset($env[$key])) {
                $env[$key] = $value;
            }
        }

        $process = new Process([
            $pythonBin,
            '-u',  // Unbuffered output
            $scriptPath,
            '--source',
            $source,
            '--output-json',
            $outputJson,
            '--output-video',
            $outputVideo,
            '--max-frames',
            (string) max(1, (int) config('ai.max_frames', 300)),
        ]);
        
        $process->setEnv($env);
        $process->setTimeout(900);
        $process->run();

        if (!$process->isSuccessful()) {
            $error = $process->getErrorOutput() ?: $process->getOutput();
            \Log::error('AI process failed', [
                'exit_code' => $process->getExitCode(),
                'error' => $error,
                'output' => $process->getOutput(),
            ]);
            return $wantsJson
                ? response()->json(['success' => false, 'message' => 'Proses AI gagal: ' . substr($error, 0, 200)], 500)
                : back()->withErrors(['ai' => 'Proses AI gagal: ' . substr($error, 0, 200)])->withInput();
        }

        if (!File::exists($outputJson)) {
            \Log::error('Output JSON not found', ['path' => $outputJson]);
            return $wantsJson
                ? response()->json(['success' => false, 'message' => 'Proses selesai, file hasil tidak ditemukan.'], 500)
                : back()->withErrors(['ai' => 'Proses selesai, file hasil tidak ditemukan.'])->withInput();
        }

        try {
            $decoded = json_decode((string) File::get($outputJson), true);
            if (!is_array($decoded)) {
                \Log::error('Invalid JSON output');
                return $wantsJson
                    ? response()->json(['success' => false, 'message' => 'Format hasil AI tidak valid.'], 500)
                    : back()->withErrors(['ai' => 'Format hasil AI tidak valid.'])->withInput();
            }

            if (!(bool) ($decoded['success'] ?? false)) {
                \Log::warning('AI analysis unsuccessful', ['message' => $decoded['message'] ?? 'Unknown error']);
                return $wantsJson
                    ? response()->json(['success' => false, 'message' => (string) ($decoded['message'] ?? 'Analisis gagal.')], 400)
                    : back()->withErrors(['ai' => (string) ($decoded['message'] ?? 'Analisis gagal.')])->withInput();
            }
        } catch (\Exception $e) {
            \Log::error('Error parsing AI output', ['error' => $e->getMessage()]);
            return $wantsJson
                ? response()->json(['success' => false, 'message' => 'Error parsing results: ' . $e->getMessage()], 500)
                : back()->withErrors(['ai' => 'Error parsing results: ' . $e->getMessage()])->withInput();
        }

        $outputVideoUrl = File::exists($outputVideo)
            ? asset('storage/akbar/ai-output/'.$runId.'.mp4')
            : null;

        \Log::info('AI analysis completed successfully', ['run_id' => $runId]);

        if ($wantsJson) {
            $weather = $decoded['dominant_weather_label'] ?? '-';
            $weatherIcon = match(true) {
                str_contains($weather, 'Cerah') && !str_contains($weather, 'Berawan') => '☀️',
                str_contains($weather, 'Cerah Berawan') => '⛅',
                str_contains($weather, 'Berawan') => '☁️',
                str_contains($weather, 'Mendung') => '🌥️',
                str_contains($weather, 'Hujan') || str_contains($weather, 'Kabut') => '🌧️',
                str_contains($weather, 'Malam') => '🌙',
                default => '🌤️',
            };

            return response()->json(array_merge($decoded, [
                'output_video_url' => $outputVideoUrl,
                'source_used' => $source,
                'weather_icon' => $weatherIcon
            ]));
        }

        return view('akbar.ai-monitor', [
            'result' => $decoded,
            'outputVideoUrl' => $outputVideoUrl,
            'sourceUsed' => $source,
        ]);
    }
}
