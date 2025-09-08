<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function customer_can_update_profile()
    {
        $customer = Customer::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Generate Sanctum token for customer
        $token = $customer->createToken('customer-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->putJson("/api/customers/{$customer->id}", [
                             'name' => 'Updated Name',
                             'email' => 'updated@example.com',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);
    }
}
