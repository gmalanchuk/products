<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'article' => $this->faker->unique()->word,
            'name' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'data' => $this->faker->randomElement([json_encode(['price' => $this->faker->randomFloat(2, 1, 1000)]), null]),
            'user_id' => User::get()->random()->id,
        ];
    }
}
