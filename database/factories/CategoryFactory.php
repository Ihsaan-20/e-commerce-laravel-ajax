<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $categoryName = $this->faker->name;
        $slug = Str::slug($categoryName, '-');

        return [
            'category_name' => $categoryName,
            'slug' => 'fake-' . $slug,
            'status' => $this->faker->randomElement(['active', 'block']),
        ];
    }
}
