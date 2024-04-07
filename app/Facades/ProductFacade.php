<?php

namespace App\Facades;

use App\Services\ProductService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static ProductService createProduct()
 * @method static ProductService setData(array $data)
 */
class ProductFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'product-service';
    }
}
