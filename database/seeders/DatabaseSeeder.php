<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\User;

use Database\Factories\ProductImageFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(20)->create();
        Product::factory(50)->create();
        ProductImage::factory(110)->create();
        CategoryProduct::factory(100)->create();
        Review::factory(300)->create();
    }
}
