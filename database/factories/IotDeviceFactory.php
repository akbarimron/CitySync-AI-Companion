<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\IotDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IotDevice>
 */
class IotDeviceFactory extends Factory
{
    protected $model = IotDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $deviceTypes = ['Camera', 'Weather_Station', 'GPS_Tracker'];
        
        return [
            'destination_id' => Destination::factory(),
            'device_type' => $this->faker->randomElement($deviceTypes),
            'stream_url' => $this->faker->url(),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
