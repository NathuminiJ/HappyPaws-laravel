<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;

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
}
