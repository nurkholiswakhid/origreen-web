<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(),
            'stats_visitor' => json_encode(['count' => $this->faker->numberBetween(1000, 100000)]),
            'stats_rating' => json_encode(['stars' => $this->faker->randomFloat(1, 3, 5)]),
        ];
    }
}
