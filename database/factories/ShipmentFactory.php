<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class ShipmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'tracking_number' => $this->faker->uuid(),
            'status' => $this->faker->randomElement(['preparing', 'shipped', 'delivered']),
        ];
    }
}
