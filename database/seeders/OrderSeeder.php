<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products to use in orders (users are optional now)
        $products = Product::all();

        // Create some sample orders
        foreach (range(1, 10) as $index) {
            $order = Order::create([
                'status' => $this->getRandomStatus(),
                'subtotal' => 0, // Will be calculated later
                'tax' => 0,      // Will be calculated later
                'total' => 0,    // Will be calculated later
            ]);

            // Add random products to the order
            $orderProducts = $products->random(rand(1, 4));
            $subtotal = 0;

            foreach ($orderProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $subtotal += ($quantity * $price);
            }

            // Calculate and update totals
            $tax = $subtotal * 0.07;
            $total = $subtotal + $tax;

            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);
        }
    }

    private function getRandomStatus(): string
    {
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        return $statuses[array_rand($statuses)];
    }
}