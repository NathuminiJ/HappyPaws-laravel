<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_list_products()
    {
        // Create sample products
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data' => [['id', 'name', 'price']]]);
    }

    /** @test */
    public function only_admin_can_create_product()
    {
        // Create an admin
        $admin = Admin::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        // Create a brand
        $brand = Brand::factory()->create();

        // Generate Sanctum token
        $token = $admin->createToken('admin-token')->plainTextToken;

        // Authenticated request as admin
        $response = $this->withHeader('Authorization', 'Bearer '.$token)
            ->postJson('/api/products', [
                'name' => 'Dog Food',
                'price' => 1000,
                'stock' => 50,
                'brand_id' => $brand->id,
                'admin_id' => $admin->id,
            ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'name', 'price']]);
    }
}
