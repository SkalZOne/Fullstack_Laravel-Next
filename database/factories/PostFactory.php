<?php

namespace Database\Factories;

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
            'title' => fake()->title(),
            'description' => fake()->text(),
            'primary_photo' => fake()->imageUrl(),
            'secondary_photo' => fake()->imageUrl(),
            'third_photo' => fake()->imageUrl(),
            'price' => fake()->numberBetween(100, 40000),
            'created_at' => fake()->date(),
        ];
    }
}
