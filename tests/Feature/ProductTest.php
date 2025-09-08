<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anyone_can_list_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    /** @test */
    public function only_admin_can_create_product()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        $brand = Brand::factory()->create();

        $token = $admin->createToken('admin-token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/products', [
                             'name' => 'New Product',
                             'description' => 'Test product',
                             'price' => 99.99,
                             'brand_id' => $brand->id,
                             'stock' => 10
                         ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'New Product']);
    }
}
