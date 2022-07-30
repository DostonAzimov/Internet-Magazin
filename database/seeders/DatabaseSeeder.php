<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DataSale;
use App\Models\HomeSlider;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(30)->create();
        Category::factory(10)->create();
        HomeSlider::factory(2)->create();
        DataSale::factory(1)->create();
    }
}
