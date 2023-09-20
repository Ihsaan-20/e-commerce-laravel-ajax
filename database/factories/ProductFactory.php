<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->name();
        $slug = Str::slug($title);
        
        $subCategories =  [1,2];
        $subCateRandKey = array_rand($subCategories);

        $brands = [1,2];
        $brandRandKey = array_rand($brands);
                
        return [
            'title' => $title,
            'slug' => $slug,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vestibulum justo nec quam congue, sit amet venenatis odio vulputate. Nulla facilisi. Cras at libero vel sapien iaculis facilisis. Suspendisse potenti. Nullam eget bibendum justo.', // Add a placeholder description
            'category_id' => 1,
            'sub_category_id' => $subCategories[$subCateRandKey],
            'brand_id' => $brands[$brandRandKey],
            'price' => rand(10, 1500),
            'sku' => rand(1000, 100000),
            'track_qty' => 'yes',
            'qty' => 10,
            'is_featured' => 'yes',
            'status' => 'active'
        ];
        
    }
}
