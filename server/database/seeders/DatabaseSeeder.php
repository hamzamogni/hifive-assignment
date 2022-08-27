<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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
        Category::factory()
            ->count(3)
            ->has(Category::factory()->count(3), "children")
            ->has(Product::factory()->count(4))
            ->create();
    }
}
