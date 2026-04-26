<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeatherReference extends Model
{
    protected $table = 'weather_reference';
    protected $fillable = ['condition_name', 'icon_code', 'security_level'];

    /**
     * Get all crowd metrics associated with this weather condition
     */
    public function crowdMetrics(): HasMany
    {
        return $this->hasMany(CrowdMetrics::class, 'weather_id');
    }
}
