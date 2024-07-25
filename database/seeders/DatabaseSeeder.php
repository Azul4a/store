<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        \App\Models\User::factory(10)->create();
//        \App\Models\Category::factory(10)->create();
//        \App\Models\Warehouse::factory(2)->create();
//        \App\Models\UserWarehouse::factory(15)->create();
//        \App\Models\Product::factory(20)->create();
        \App\Models\ProductCharacteristic::factory(10)->create();
        \App\Models\WarehouseStock::factory(20)->create();
    }
}
