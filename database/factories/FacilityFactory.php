<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'display_type' => $this->faker->randomElement(['image', 'icon']),
            'icon' => 'fas fa-' . $this->faker->word(),
            'main_icon' => 'fas fa-' . $this->faker->word(),
            'image_url' => $this->faker->imageUrl(),
            'duration' => $this->faker->numberBetween(30, 300),
            'type' => $this->faker->randomElement(['wahana', 'fasilitas']),
            'is_active' => $this->faker->boolean(),
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
