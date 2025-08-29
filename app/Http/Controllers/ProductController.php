<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            Product::with(['brand', 'admin'])->get()
        );
    }

    public function show($id)
    {
        return new ProductResource(
            Product::with(['brand', 'admin'])->findOrFail($id)
        );
    }

    
public function store(StoreProductRequest $request)
{
    $product = Product::create($request->validated());
    return response()->json($product, 201);
}

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
