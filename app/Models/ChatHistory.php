<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatHistory extends Model
{
    use HasFactory;
    protected $table = 'chat_history';

    protected $fillable = [
        'session_id',
        'sender',
        'message_text',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function chatSession(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class, 'session_id');
    }
}
