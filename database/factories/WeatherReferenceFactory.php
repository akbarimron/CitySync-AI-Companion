<?php

namespace Database\Factories;

use App\Models\WeatherReference;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WeatherReference>
 */
class WeatherReferenceFactory extends Factory
{
    protected $model = WeatherReference::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conditions = ['Sunny', 'Rainy', 'Cloudy', 'Stormy', 'Snowy', 'Foggy', 'Windy'];
        
        return [
            'condition_name' => $this->faker->unique()->randomElement($conditions),
            'icon_code' => $this->faker->lexify('????'),
            'security_level' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
