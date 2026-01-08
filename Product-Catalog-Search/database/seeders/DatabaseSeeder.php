<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['name' => 'Sports', 'slug' => 'sports'],
        ];

        foreach($categories as $category){
            Category::create($category);
        }

        $products = [
            ['name' => 'Wireless Headphones', 'price' => 99.99, 'category_id' => 1],
            ['name' => 'Smart Watch', 'price' => 199.99, 'category_id' => 1],
            ['name' => 'Cotton T-Shirt', 'price' => 24.99, 'category_id' => 2],
            ['name' => 'Laravel Guide Book', 'price' => 39.99, 'category_id' => 3],
            ['name' => 'Garden Tool Set', 'price' => 49.99, 'category_id' => 4],
            ['name' => 'Yoga Mat', 'price' => 29.99, 'category_id' => 5],
            ['name' => 'Bluetooth Speaker', 'price' => 79.99, 'category_id' => 1],
            ['name' => 'Running Shoes', 'price' => '89.99', 'category_id' => 2],
        ];

        foreach($products as $product){
            Product::create([
                'name' => $product['name'],
                'slug' => strtolower(str_replace('', '-', $product['name'])),
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'price' => $product['price'],
                'category_id' => $product['category_id'],
                'stock' => rand(0, 100),
                'is_active' => true,
            ]);
        }
    }
}
