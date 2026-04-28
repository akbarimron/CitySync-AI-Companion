<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akbar AI Monitor</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
<main class="mx-auto w-full max-w-[1600px] p-4 md:p-6 lg:p-8">
    <header class="mb-6 rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold">Akbar - AI Monitor (YOLO + MobileNet)</h1>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                    Analisis video/stream untuk deteksi keramaian (person count) dan klasifikasi cuaca.
                </p>
            </div>
            <a href="{{ route('akbar.street-view.index') }}" class="inline-flex rounded-lg bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Kembali ke Street View
            </a>
        </div>
    </header>

    <section class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-900 lg:col-span-4">
            <h2 class="mb-4 text-lg font-semibold">Jalankan Analisis AI</h2>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form id="analysisForm" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="video_file" class="mb-2 block text-sm font-medium">Upload Video (.mp4/.avi/.mov/.mkv/.webm)</label>
                    <input
                        id="video_file"
                        name="video_file"
                        type="file"
                        accept="video/*"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm dark:border-slate-600 dark:bg-slate-800"
                    />
                    <p id="fileInfo" class="mt-1 text-xs text-slate-500"></p>
                </div>

                <div>
                    <label for="video_source" class="mb-2 block text-sm font-medium">Atau URL/Path Source (RTSP/HTTP/local path/0)</label>
                    <input
                        id="video_source"
                        name="video_source"
                        type="text"
                        placeholder="Contoh: 0 atau rtsp://... atau D:\video\test.mp4"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm dark:border-slate-600 dark:bg-slate-800"
                    />
                </div>

                <button 
                    id="submitBtn"
                    type="submit" 
                    class="inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span id="btnText">Jalankan YOLO + MobileNet</span>
                    <span id="btnSpinner" class="hidden ml-2">
                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </form>

            <script>
                const form = document.getElementById('analysisForm');
                const fileInput = document.getElementById('video_file');
                const sourceInput = document.getElementById('video_source');
                const submitBtn = document.getElementById('submitBtn');
                const fileInfo = document.getElementById('fileInfo');

                const MAX_FILE_SIZE_MB = 500;
                const MAX_FILE_SIZE_BYTES = MAX_FILE_SIZE_MB * 1024 * 1024;

                // Show file info when selected
                fileInput.addEventListener('change', function(e) {
                    if (this.files.length > 0) {
                        const file = this.files[0];
                        const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        if (file.size > MAX_FILE_SIZE_BYTES) {
                            fileInfo.textContent = `⚠ File terlalu besar: ${sizeMB} MB (maks ${MAX_FILE_SIZE_MB} MB)`;
                            fileInfo.className = 'mt-1 text-xs text-red-600';
                            this.value = '';
                        } else {
                            fileInfo.textContent = `✓ File: ${file.name} (${sizeMB} MB)`;
                            fileInfo.className = 'mt-1 text-xs text-green-600';
                        }
                    } else {
                        fileInfo.textContent = '';
                    }
                });

                // Handle form submission
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const hasFile = fileInput.files.length > 0;
                    const hasSource = sourceInput.value.trim().length > 0;
                    
                    if (!hasFile && !hasSource) {
                        fileInfo.textContent = '⚠ Pilih file atau isi URL/path source!';
                        fileInfo.className = 'mt-1 text-xs text-red-600';
                        return false;
                    }

                    if (hasFile && fileInput.files[0].size > MAX_FILE_SIZE_BYTES) {
                        const sizeMB = (fileInput.files[0].size / (1024 * 1024)).toFixed(2);
                        fileInfo.textContent = `⚠ File terlalu besar: ${sizeMB} MB (maks ${MAX_FILE_SIZE_MB} MB)`;
                        fileInfo.className = 'mt-1 text-xs text-red-600';
                        return false;
                    }

                    // Show loading
                    submitBtn.disabled = true;
                    document.getElementById('btnText').classList.add('hidden');
                    document.getElementById('btnSpinner').classList.remove('hidden');

                    try {
                        // Build FormData with all fields
                        const formData = new FormData();
                        
                        // Add CSRF token
                        const token = document.querySelector('input[name="_token"]').value;
                        formData.append('_token', token);
                        
                        // Add file if present
                        if (hasFile) {
                            formData.append('video_file', fileInput.files[0]);
                        }
                        
                        // Add source if present
                        if (hasSource) {
                            formData.append('video_source', sourceInput.value.trim());
                        }

                        console.log('Submitting form with:', {
                            hasFile: hasFile,
                            fileName: hasFile ? fileInput.files[0].name : null,
                            fileSize: hasFile ? fileInput.files[0].size : null,
                            source: sourceInput.value.trim()
                        });

                        // Submit via fetch for better control
                        const response = await fetch('{{ route("akbar.ai-monitor.analyze") }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        });

                        console.log('Response status:', response.status);

                        if (response.ok) {
                            // Redirect to results page
                            const html = await response.text();
                            // Check if response contains result data
                            if (html.includes('Hasil Analisis')) {
                                document.open();
                                document.write(html);
                                document.close();
                            } else {
                                window.location.reload();
                            }
                        } else {
                            const errorText = await response.text();
                            console.error('Upload failed:', errorText);
                            fileInfo.textContent = '⚠ Upload gagal. Coba lagi atau gunakan video source path.';
                            fileInfo.className = 'mt-1 text-xs text-red-600';
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        fileInfo.textContent = '⚠ Error: ' + error.message;
                        fileInfo.className = 'mt-1 text-xs text-red-600';
                    } finally {
                        submitBtn.disabled = false;
                        document.getElementById('btnText').classList.remove('hidden');
                        document.getElementById('btnSpinner').classList.add('hidden');
                    }
                });
            </script>

            <div class="mt-5 rounded-lg bg-amber-50 p-3 text-xs text-amber-800 dark:bg-amber-900/40 dark:text-amber-200">
                <p class="font-semibold">Pastikan environment Python sudah siap:</p>
                <p class="mt-2 font-mono">pip install opencv-python ultralytics torch torchvision pillow</p>
                <p class="mt-2">Jalankan juga <span class="font-mono">php artisan storage:link</span> agar video output bisa diputar dari browser.</p>
            </div>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-900 lg:col-span-8">
            <h2 class="mb-4 text-lg font-semibold">Hasil Analisis</h2>

            @if ($result)
                {{-- Rekomendasi utama --}}
                @php
                    $crowdLevel = $result['crowd_level'] ?? null;
                    $recommendation = $result['visit_recommendation'] ?? null;
                    $weather = $result['dominant_weather_label'] ?? '-';
                    $recColor = match(true) {
                        str_contains($recommendation ?? '', 'Ideal') => 'bg-green-50 border-green-300 text-green-800 dark:bg-green-900/30 dark:text-green-200',
                        str_contains($recommendation ?? '', 'Siap') => 'bg-blue-50 border-blue-300 text-blue-800 dark:bg-blue-900/30 dark:text-blue-200',
                        str_contains($recommendation ?? '', 'Pertimbangkan') => 'bg-yellow-50 border-yellow-300 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200',
                        str_contains($recommendation ?? '', 'Perlu') => 'bg-orange-50 border-orange-300 text-orange-800 dark:bg-orange-900/30 dark:text-orange-200',
                        str_contains($recommendation ?? '', 'Kurang') => 'bg-red-50 border-red-300 text-red-800 dark:bg-red-900/30 dark:text-red-200',
                        default => 'bg-slate-100 border-slate-300 text-slate-700 dark:bg-slate-800 dark:text-slate-200',
                    };
                    $weatherIcon = match(true) {
                        str_contains($weather, 'Cerah') && !str_contains($weather, 'Berawan') => '☀️',
                        str_contains($weather, 'Cerah Berawan') => '⛅',
                        str_contains($weather, 'Berawan') => '☁️',
                        str_contains($weather, 'Mendung') => '🌥️',
                        str_contains($weather, 'Hujan') || str_contains($weather, 'Kabut') => '🌧️',
                        str_contains($weather, 'Malam') => '🌙',
                        default => '🌤️',
                    };
                    $crowdIcon = match($crowdLevel) {
                        'Sepi' => '🟢',
                        'Sedang' => '🟡',
                        'Ramai' => '🟠',
                        'Sangat Ramai' => '🔴',
                        default => '⚪',
                    };
                @endphp

                @if ($recommendation)
                <div class="mb-4 rounded-lg border px-4 py-3 text-sm font-medium {{ $recColor }}">
                    <span class="text-base">💡</span> {{ $recommendation }}
                </div>
                @endif

                {{-- Statistik utama --}}
                <div class="mb-4 grid grid-cols-2 gap-3 md:grid-cols-4">
                    <div class="rounded-lg bg-slate-100 p-3 dark:bg-slate-800">
                        <p class="text-xs text-slate-500 dark:text-slate-400">Kondisi Cuaca</p>
                        <p class="mt-1 text-lg font-bold">{{ $weatherIcon }} {{ $weather }}</p>
                    </div>
                    <div class="rounded-lg bg-slate-100 p-3 dark:bg-slate-800">
                        <p class="text-xs text-slate-500 dark:text-slate-400">Tingkat Keramaian</p>
                        <p class="mt-1 text-lg font-bold">{{ $crowdIcon }} {{ $crowdLevel ?? '-' }}</p>
                    </div>
                    <div class="rounded-lg bg-slate-100 p-3 dark:bg-slate-800">
                        <p class="text-xs text-slate-500 dark:text-slate-400">Rata-rata Pengunjung</p>
                        <p class="mt-1 text-lg font-bold">{{ $result['avg_person_count'] ?? '-' }} orang</p>
                    </div>
                    <div class="rounded-lg bg-slate-100 p-3 dark:bg-slate-800">
                        <p class="text-xs text-slate-500 dark:text-slate-400">Puncak Pengunjung</p>
                        <p class="mt-1 text-lg font-bold">{{ $result['max_person_count'] ?? '-' }} orang</p>
                    </div>
                </div>

                {{-- Detail distribusi cuaca --}}
                @if (!empty($result['weather_distribution']))
                <div class="mb-4 rounded-lg border border-slate-200 p-3 dark:border-slate-700">
                    <p class="mb-2 text-xs font-semibold text-slate-500 dark:text-slate-400">Distribusi Kondisi Cuaca (dari {{ $result['frames_processed'] ?? 0 }} frame)</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($result['weather_distribution'] as $label => $count)
                            <span class="rounded-full bg-slate-200 px-2 py-0.5 text-xs dark:bg-slate-700">
                                {{ $label }}: {{ $count }}x
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Video output --}}
                @if ($outputVideoUrl)
                    <video controls class="h-[55vh] min-h-[360px] w-full rounded-lg border border-slate-200 bg-black dark:border-slate-700">
                        <source src="{{ $outputVideoUrl }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                    @if (!($result['video_converted_h264'] ?? false))
                        <p class="mt-1 text-xs text-amber-600 dark:text-amber-400">
                            ⚠ Video belum di-convert ke H.264 (ffmpeg tidak ditemukan). Install ffmpeg agar video bisa diputar di browser.
                        </p>
                    @endif
                @else
                    <div class="rounded-lg bg-yellow-50 px-3 py-2 text-sm text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200">
                        Output video tidak ditemukan, tetapi analisis metadata berhasil.
                    </div>
                @endif
            @else
                <div class="rounded-lg bg-slate-100 px-3 py-4 text-sm text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                    Belum ada hasil. Upload video atau isi source, lalu klik tombol analisis.
                </div>
            @endif
        </article>
    </section>
</main>
</body>
</html>
