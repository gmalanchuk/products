<?php

namespace App\Http\Controllers;

use App\Facades\ProductFacade;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['store', 'update', 'destroy']),
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

    public function show(Product $product)
    {
        // TODO сделать проверку: пользователь админ - отдаём любой продукт, даже который не доступен
        // если пользователь не аутентифицирован или не является админом - отдаём только доступные продукты, иначе 404
        // TODO сделать политику
        return new ProductResource($product);  // Return the product
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        Gate::authorize('update', $product);  // Check if the user can update the product (only the owner or admin can update the product)
        $product = ProductFacade::setData($request->validated())->updateProduct($product);  // Updating the product in the ProductService class
        return new ProductResource($product);  // Return the updated product
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        Gate::authorize('delete', $product);  // Check if the user can delete the product (only the owner or admin can delete the product)
        $product->delete();  // Soft delete the product
        return response()->noContent();
    }
}
