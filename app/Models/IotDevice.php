<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IotDevice extends Model
{
    protected $fillable = [
        'destination_id',
        'device_type',
        'stream_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the destination for this IoT device
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    /**
     * Get all crowd metrics for this device
     */
    public function crowdMetrics(): HasMany
    {
        return $this->hasMany(CrowdMetrics::class, 'device_id');
    }
}
