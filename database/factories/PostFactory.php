<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'body' => fake()->paragraph(5, true),
            'image' => "https://picsum.photos/800/600?random=" . rand(1, 1000),
            'user_id' => User::inRandomorder()->first()->id,
            'is_approved' => fake()->boolean(),
            'province' => fake()->randomElement(['Murcia', 'Madrid', 'Alicante', 'Cuenca']),
            'difficulty' => fake()->randomElement(['Easy', 'Medium', 'Hard']),
            'longitude' => fake()->randomFloat(2, 0, 999),
            'altitude' => fake()->numberBetween(0, 9000),
            'time' => fake()->time(),
            'track' => 'tracks/' . fake()->word() . '.kml',
        ];
    }
}
