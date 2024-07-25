<?php

namespace Database\Factories;

use App\Models\UserWarehouse;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserWarehouseFactory extends Factory
{
    protected $model = UserWarehouse::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'warehouse_id' => Warehouse::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

