<?php

namespace Database\Factories;

use App\Models\ChatHistory;
use App\Models\ChatSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChatHistory>
 */
class ChatHistoryFactory extends Factory
{
    protected $model = ChatHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senders = ['User', 'AI'];
        
        return [
            'session_id' => ChatSession::factory(),
            'sender' => $this->faker->randomElement($senders),
            'message_text' => $this->faker->paragraph(),
            'sent_at' => $this->faker->dateTime(),
        ];
    }
}
