<?php

namespace App\Providers;

use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Policies\ProductPolicy;
use App\Services\ProductService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('product', ProductService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Product::class, ProductPolicy::class);

        ProductResource::withoutWrapping();
    }
}
