<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrowdMetrics extends Model
{
    protected $fillable = [
        'device_id',
        'timestamp',
        'occupancy_count',
        'weather_id',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    /**
     * Get the IoT device for these metrics
     */
    public function iotDevice(): BelongsTo
    {
        return $this->belongsTo(IotDevice::class, 'device_id');
    }

    /**
     * Get the weather condition for these metrics
     */
    public function weatherCondition(): BelongsTo
    {
        return $this->belongsTo(WeatherReference::class, 'weather_id');
    }
}
