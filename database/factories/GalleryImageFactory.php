<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryImage>
 */
class GalleryImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'path' => 'images/' . $this->faker->uuid . '.jpg',
            'title' => $this->faker->sentence(3),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
