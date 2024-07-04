<?php

namespace App\Http\Controllers;

use App\Facades\ProductFacade;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Products API",
 *      description="API for products management",
 * )
 */
class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', only: ['store', 'update', 'destroy']),
// TODO           new Middleware('verified', only: ['store']), // Only users with verified email can create a product
        ];
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     @OA\Response(response="200", description="Return collection of products")
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::scopeAvailable(Product::all());  // Get all available products
        return ProductResource::collection($products);  // Return collection of products
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     @OA\Response(response="201", description="Return created product")
     * )
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $product = ProductFacade::setData($request->validated())->createProduct();  // Creating a new product in the ProductService class
        return new ProductResource($product);  // Return the created product
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     @OA\Response(response="200", description="Return product by id")
     * )
     */
    public function show(Product $product): ProductResource
    {
//        dd($product->status);
        Gate::authorize('view', $product);  // Check if the user can view the product (only the owner or admin can view the unavailable product)
        return new ProductResource($product);  // Return the product
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     @OA\Response(response="200", description="Return updated product")
     * )
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        Gate::authorize('update', $product);  // Check if the user can update the product (only the owner or admin can update the product)
        $product = ProductFacade::setData($request->validated())->updateProduct($product);  // Updating the product in the ProductService class
        return new ProductResource($product);  // Return the updated product
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     @OA\Response(response="204", description="No content")
     * )
     */
    public function destroy(string $id): Response
    {
        $product = Product::findOrFail($id);
        Gate::authorize('delete', $product);  // Check if the user can delete the product (only the owner or admin can delete the product)
        $product->delete();  // Soft delete the product
        return response()->noContent();
    }
}
