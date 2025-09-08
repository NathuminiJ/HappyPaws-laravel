<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function customer_can_place_order()
    {
        $customer = Customer::factory()->create([
            'password' => Hash::make('password'),
        ]);
        $product = Product::factory()->create();

        // Generate Sanctum token for customer
        $token = $customer->createToken('customer-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/orders', [
                             'customer_id' => $customer->id,
                             'products' => [
                                 ['id' => $product->id, 'quantity' => 2]
                             ]
                         ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'customer', 'products']]);
    }
}
