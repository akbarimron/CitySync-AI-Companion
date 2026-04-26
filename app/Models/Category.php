<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Get all destinations for this category
     */
    public function destinations(): HasMany
    {
        return $this->hasMany(Destination::class);
    }

    /**
     * Get all user preferences for this category
     */
    public function userPreferences(): HasMany
    {
        return $this->hasMany(UserPreference::class);
    }
}
