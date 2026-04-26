<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = ['user_id', 'category_id', 'interest_score'];

    /**
     * Get the user associated with this preference
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category associated with this preference
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
