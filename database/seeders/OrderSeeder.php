<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipment;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(5)->create()->each(function ($order) {
            // Add Payment & Shipment
            Payment::factory()->create(['order_id' => $order->id, 'amount' => $order->total_amount]);
            Shipment::factory()->create(['order_id' => $order->id]);

            // Attach products to the order
            $products = Product::inRandomOrder()->take(2)->pluck('id');
            foreach ($products as $productId) {
                $order->products()->attach($productId, [
                    'quantity' => rand(1, 3),
                    'price' => rand(10, 200),
                ]);
            }
        });
    }
}
