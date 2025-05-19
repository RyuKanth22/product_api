<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $categoryIds = Category::pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => "Producto $i",
                'description' => "Descripción del producto $i",
                'price' => rand(10, 100),
                'stock' => rand(1, 50),
                'category_id' => $categoryIds[array_rand($categoryIds)],
            ]);
        }
    }
}
