<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Hash;

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

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $data = $request->validated();

        // Hash password if being updated
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $customer->update($data);

        return new CustomerResource($customer);
    }
}
