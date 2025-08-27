<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register Customer
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:customers',
            'password' => 'required|string|min:6',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json([
            'customer' => $customer,
            'token' => $token
        ]);
    }

    // Login Customer
    public function loginCustomer(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();

        if (! $customer || ! Hash::check($request->password, $customer->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json([
            'customer' => $customer,
            'token' => $token
        ]);
    }

    // Login Admin
    public function loginAdmin(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;

        return response()->json([
            'admin' => $admin,
            'token' => $token
        ]);
    }
}
