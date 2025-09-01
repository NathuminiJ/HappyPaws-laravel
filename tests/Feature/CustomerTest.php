<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function customer_can_update_profile()
    {
        // Create a customer with a known password
        $customer = Customer::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        // Create Sanctum token
        $token = $customer->createToken('customer-token')->plainTextToken;

        // Send authenticated request with Bearer token
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson("/api/customers/{$customer->id}", [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ]);

        // Assert success
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);
    }
}
