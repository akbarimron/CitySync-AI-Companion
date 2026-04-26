<?php

namespace Database\Factories;

use App\Models\CrowdMetrics;
use App\Models\IotDevice;
use App\Models\WeatherReference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CrowdMetrics>
 */
class CrowdMetricsFactory extends Factory
{
    protected $model = CrowdMetrics::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_id' => IotDevice::factory(),
            'timestamp' => $this->faker->dateTimeBetween('-7 days'),
            'occupancy_count' => $this->faker->randomNumber(3, false),
            'weather_id' => WeatherReference::factory(),
        ];
    }
}
