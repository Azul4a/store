<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCharacteristic;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->numerify('SKU-#####'),
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'old_price' => $this->faker->optional()->randomFloat(2, 1, 100),
            'description' => $this->faker->optional()->sentence,
            'category_id' => Category::factory(),
            'is_published' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

