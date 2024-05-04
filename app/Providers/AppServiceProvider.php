<?php

namespace App\Providers;

use App\Http\Resources\Auth\TokenResource;
use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\Product\ProductResource;
use App\Services\AuthService;
use App\Services\EmailService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('product-service', ProductService::class);
        $this->app->bind('auth-service', AuthService::class);
        $this->app->bind('email-service', EmailService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ProductResource::withoutWrapping();
        UserResource::withoutWrapping();
        TokenResource::withoutWrapping();
    }
}
