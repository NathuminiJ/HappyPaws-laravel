<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(
            Order::with(['customer', 'products', 'payment', 'shipment'])->get()
        );
    }

    public function show($id)
    {
        return new OrderResource(
            Order::with(['customer', 'products', 'payment', 'shipment'])->findOrFail($id)
        );
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        // Create new order
        $order = Order::create([
            'customer_id' => $data['customer_id'],
            'status' => 'pending',
            'total_amount' => 0, // optional: calculate from products
        ]);

        // Attach products with quantity and price to pivot table
        foreach ($data['products'] as $productData) {
            $product = \App\Models\Product::find($productData['id']);
            $order->products()->attach($productData['id'], [
                'quantity' => $productData['quantity'],
                'price' => $product->price
            ]);
        }

        return new OrderResource(
            $order->load(['customer', 'products', 'payment', 'shipment'])
        );
    }
}
