<?php

namespace App\Services;

use App\Jobs\ProductCreatedJob;

class ProductService
{
    private array $data;

    public function createProduct()
    {
        $user = auth()->user();
        $product = $user->products()->create($this->data);

        ProductCreatedJob::dispatch($product, $user);

        return $product;
    }

    public function updateProduct($product)
    {
        $product->update($this->data);
        return $product;
    }

    public function setData(array $data): ProductService
    {
        $this->data = $data;
        return $this;
    }
}
