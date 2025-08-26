<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function index()
    {
        return BrandResource::collection(
            Brand::with('products')->get()
        );
    }

    public function show($id)
    {
        return new BrandResource(
            Brand::with('products')->findOrFail($id)
        );
    }
}
