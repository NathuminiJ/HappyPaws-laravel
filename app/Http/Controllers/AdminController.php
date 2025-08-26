<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Resources\AdminResource;

class AdminController extends Controller
{
    public function index()
    {
        return AdminResource::collection(
            Admin::with('products')->get()
        );
    }

    public function show($id)
    {
        return new AdminResource(
            Admin::with('products')->findOrFail($id)
        );
    }
}
