<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialMedia>
 */
class SocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platforms = ['Facebook', 'Instagram', 'Twitter', 'LinkedIn', 'YouTube', 'TikTok'];
        $platform = $this->faker->randomElement($platforms);

        return [
            'platform' => $platform,
            'url' => $this->faker->url(),
            'icon' => 'fab fa-' . strtolower($platform),
            'is_active' => $this->faker->boolean(),
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
