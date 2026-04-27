<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'latitude',
        'longitude',
        'description',
        'base_price',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'base_price' => 'decimal:2',
    ];

    /**
     * Get the category for this destination
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all IoT devices for this destination
     */
    public function iotDevices(): HasMany
    {
        return $this->hasMany(IotDevice::class);
    }
}
