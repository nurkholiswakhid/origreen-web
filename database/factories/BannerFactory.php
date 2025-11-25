<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
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
            'description' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(),
            'button1_text' => $this->faker->word(),
            'button1_url' => $this->faker->url(),
            'button2_text' => $this->faker->word(),
            'button2_url' => $this->faker->url(),
        ];
    }
}
