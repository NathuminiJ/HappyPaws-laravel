<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    public function index()
    {
        return CustomerResource::collection(
            Customer::with(['orders', 'subscriptions'])->get()
        );
    }

    public function show($id)
    {
        return new CustomerResource(
            Customer::with(['orders', 'subscriptions'])->findOrFail($id)
        );
    }
}
