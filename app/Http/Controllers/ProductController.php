<?php

namespace App\Http\Controllers;

use App\Facades\ProductFacade;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['store']),
        ];
    }

    public function index()
    {
        $products = Product::scopeAvailable(Product::all());  // Get all available products
        return ProductResource::collection($products);  // Return collection of products
    }

    public function store(StoreProductRequest $request)
    {
        $product = ProductFacade::setData($request->validated())->createProduct();  // Creating a new product in the ProductService class
        return new ProductResource($product);  // Return the created product
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
