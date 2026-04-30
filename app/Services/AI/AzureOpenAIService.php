<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;

class AzureOpenAIService
{
    public function sendMessage($message)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'api-key' => env('AZURE_OPENAI_KEY'),
        ])->post(env('AZURE_OPENAI_ENDPOINT'), [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are City Companion AI. Always respond ONLY in JSON format with this structure:

                    {
                    "reply": "short explanation to user",
                    "route": {
                        "title": "route name",
                        "match": "percentage match",
                        "steps": [
                        {
                            "time": "HH:MM",
                            "activity": "activity name",
                            "info": "short info"
                        }
                        ],
                        "summary": "final summary"
                    }
                    }

                    Do not return anything outside JSON.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'max_tokens' => 300,
            'temperature' => 0.2
        ]);

        if ($response->failed()) {
            return json_encode([
                'reply' => 'AI error 😢',
                'route' => null
            ]);
        }

        return $response['choices'][0]['message']['content'] ?? '{}';
    }
}