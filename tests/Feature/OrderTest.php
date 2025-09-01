<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function customer_can_place_order()
    {
        // Create a customer with password
        $customer = Customer::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        // Generate Sanctum token for the customer
        $token = $customer->createToken('customer-token')->plainTextToken;

        // Create a product
        $product = Product::factory()->create();

        // Authenticated request
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/orders', [
                'customer_id' => $customer->id,
                'products' => [
                    ['id' => $product->id, 'quantity' => 2]
                ]
            ]);

        // Assert success
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'customer',
                         'products'
                     ]
                 ]);
    }
}
