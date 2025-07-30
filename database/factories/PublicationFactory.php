<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use  App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->paragraphs(3, true),
            // 'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
