<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_method' => $this->faker->randomElement(['card', 'paypal']),
            'status' => $this->faker->randomElement(['paid', 'unpaid', 'failed']),
            'amount' => $this->faker->randomFloat(2, 20, 1000),
        ];
    }
}
