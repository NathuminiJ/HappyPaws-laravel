<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'plan' => $this->faker->randomElement(['Basic', 'Standard', 'Pro']),
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'active' => true,
        ];
    }
}
