<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $images = [
            'posts/imagen1.jpg',
            'posts/imagen2.jpg',
            'posts/imagen3.jpg',
            'posts/imagen4.jpg',
            'posts/imagen5.jpg',
            'posts/imagen6.jpg',
            'posts/imagen7.jpg',
        ];

        $randomImage = $images[array_rand($images)];

        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'body' => fake()->paragraph(5, true),
            'image' => $randomImage,
            'user_id' => User::inRandomorder()->first()->id,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'province' => fake()->randomElement(['Murcia', 'Madrid', 'Alicante', 'Cuenca']),
            'difficulty' => fake()->randomElement(['Fácil', 'Moderado', 'Difícil']),
            'longitude' => fake()->randomFloat(2, 0, 999),
            'altitude' => fake()->numberBetween(0, 9000),
            'duration' => fake()->numberBetween(30, 600),
            'track' => 'tracks/' . fake()->word() . '.kml',
        ];
    }
}
