<?php

namespace App\Http\Controllers\Personalization\Chatbot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AI\AzureOpenAIService;

class ChatController extends Controller
{
    protected $ai;

    public function __construct(AzureOpenAIService $ai)
    {
        $this->ai = $ai;
    }

    public function index()
    {
        return view('personalization/index');
    }

    public function sendMessage(Request $request)
    {
        $raw = $this->ai->sendMessage($request->message);

        $decoded = json_decode($raw, true);

        // fallback kalau AI error
        if (!$decoded) {
            return response()->json([
                'data' => [
                    'reply' => 'AI gagal parse 😢',
                    'route' => null
                ]
            ]);
        }

        return response()->json([
            'data' => $decoded
        ]);
    }
}