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
            'total_price' => 0, // optional: calculate from products
        ]);

        // Attach products with quantity to pivot table
        foreach ($data['products'] as $product) {
            $order->products()->attach($product['id'], [
                'quantity' => $product['quantity']
            ]);
        }

        return new OrderResource(
            $order->load(['customer', 'products', 'payment', 'shipment'])
        );
    }
}
