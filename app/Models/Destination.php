<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $fillable = [
        'category_id',
        'slug',
        'name',
        'latitude',
        'longitude',
        'description',
        'base_price',
        'is_featured',
        'featured_rank',
        'metadata',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'base_price' => 'decimal:2',
        'metadata' => 'array',
        'is_featured' => 'boolean',
        'featured_rank' => 'integer',
    ];

    /**
     * Scope featured destinations.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope destinations in display order.
     */
    public function scopeOrdered($query)
    {
        return $query
            ->orderByDesc('is_featured')
            ->orderBy('featured_rank')
            ->orderBy('name');
    }

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

    /**
     * Get crowd metrics for all devices under this destination.
     */
    public function crowdMetrics(): HasManyThrough
    {
        return $this->hasManyThrough(CrowdMetrics::class, IotDevice::class, 'destination_id', 'device_id');
    }

    /**
     * Metadata helper.
     */
    public function meta(string $key, mixed $default = null): mixed
    {
        return data_get($this->metadata ?? [], $key, $default);
    }

    public function getDisplayImageUrlAttribute(): string
    {
        $fallbackImage = 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&h=800&fit=crop';

        if ($this->slug === 'kota-tua-jakarta' || $this->slug === 'kota-tua') {
            $fallbackImage = 'https://images.unsplash.com/photo-1513622470522-26c3c8a854bc?w=1200&h=800&fit=crop';
        }

        return (string) $this->meta('image_url', $fallbackImage);
    }

    public function getStreetViewEmbedUrlAttribute(): string
    {
        return (string) $this->meta('street_view_url', $this->streetViewFallbackUrl());
    }

    public function getDemoVideoUrlAttribute(): string
    {
        return (string) $this->meta('demo_video_url', 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4');
    }

    public function getDisplayAddressAttribute(): string
    {
        return (string) $this->meta('address', $this->name);
    }

    public function getDisplayAreaAttribute(): string
    {
        return (string) $this->meta('area', $this->category?->name ?? 'Jakarta');
    }

    public function getDisplayRatingAttribute(): float
    {
        return (float) $this->meta('rating', 4.5);
    }

    public function getDisplayCrowdAttribute(): int
    {
        return (int) $this->meta('crowd_percentage', 0);
    }

    public function getDisplayWeatherAttribute(): string
    {
        return (string) $this->meta('weather', 'Cerah');
    }

    public function getDisplayOpeningHoursAttribute(): string
    {
        return (string) $this->meta('opening_hours', '08:00 - 17:00 WIB');
    }

    public function getDisplayBestTimeAttribute(): string
    {
        return (string) $this->meta('best_time', 'Pagi hari');
    }

    public function getDisplayTipAttribute(): string
    {
        return (string) $this->meta('tip', $this->description);
    }

    public function getDisplayVisitorsAttribute(): string
    {
        return (string) $this->meta('visitors', '0');
    }

    public function getDisplayConfidenceAttribute(): int
    {
        return (int) $this->meta('confidence', 92);
    }

    public function getPreviewCopyAttribute(): string
    {
        return (string) $this->meta('preview_copy', $this->description);
    }

    public function streetViewFallbackUrl(): string
    {
        return 'https://www.google.com/maps?q=&layer=c&cbll=' . $this->latitude . ',' . $this->longitude . '&cbp=11,0,0,0,0';
    }

    public function toUiArray(): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'category' => $this->category?->name,
            'description' => $this->description,
            'price' => (float) $this->base_price,
            'rating' => $this->display_rating,
            'crowd' => $this->display_crowd,
            'weather' => $this->display_weather,
            'opening_hours' => $this->display_opening_hours,
            'best_time' => $this->display_best_time,
            'tip' => $this->display_tip,
            'address' => $this->display_address,
            'area' => $this->display_area,
            'lat' => (float) $this->latitude,
            'lng' => (float) $this->longitude,
            'image_url' => $this->display_image_url,
            'street_view_url' => $this->street_view_embed_url,
            'demo_video_url' => $this->demo_video_url,
            'is_featured' => $this->is_featured,
            'featured_rank' => $this->featured_rank,
            'visitors' => $this->display_visitors,
            'confidence' => $this->display_confidence,
            'preview_copy' => $this->preview_copy,
        ];
    }
}
