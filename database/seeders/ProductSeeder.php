<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample products
        Product::create([
            'name' => 'Laptop Computer',
            'description' => 'High-performance laptop with 16GB RAM and 512GB SSD',
            'price' => 999.99,
        ]);

        Product::create([
            'name' => 'Smartphone',
            'description' => 'Latest smartphone with 128GB storage and dual camera system',
            'price' => 699.99,
        ]);

        Product::create([
            'name' => 'Wireless Headphones',
            'description' => 'Noise-cancelling wireless headphones with 30-hour battery life',
            'price' => 199.99,
        ]);

        Product::create([
            'name' => 'Smart Watch',
            'description' => 'Fitness tracker and smartwatch with heart rate monitor',
            'price' => 249.99,
        ]);

        Product::create([
            'name' => 'Tablet',
            'description' => '10-inch tablet with high-resolution display and stylus support',
            'price' => 399.99,
        ]);

        Product::create([
            'name' => 'Gaming Console',
            'description' => 'Next-generation gaming console with 1TB storage',
            'price' => 499.99,
        ]);

        Product::create([
            'name' => 'Bluetooth Speaker',
            'description' => 'Waterproof Bluetooth speaker with 360-degree sound',
            'price' => 129.99,
        ]);

        Product::create([
            'name' => 'Digital Camera',
            'description' => '24MP digital camera with 4K video recording',
            'price' => 599.99,
        ]);

        // Create additional products using factory
        \Database\Factories\ProductFactory::new()->count(10)->create();
    }
}