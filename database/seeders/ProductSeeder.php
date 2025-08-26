<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Admin;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(10)->create([
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'admin_id' => Admin::inRandomOrder()->first()->id,
        ]);
    }
}
