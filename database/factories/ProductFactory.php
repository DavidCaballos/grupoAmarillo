<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

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
        $product_name = $this->faker->unique()->words($nb=2,$asText = true);
        $slug = Str::slug($product_name);
        return [
            'name' => Str::title($product_name),
            'slug' => $slug,    
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(1,22),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween (100,200),
            'image' => $this->faker->numberBetween (1,5).'.jpg',
            'category' => Str::title('Watches')
        ];
    }
}


