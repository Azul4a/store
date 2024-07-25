<?php

namespace Database\Factories;

use App\Models\ProductCharacteristic;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCharacteristicFactory extends Factory
{
    protected $model = ProductCharacteristic::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'value' => $this->faker->word,
            'product_id' => Product::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

