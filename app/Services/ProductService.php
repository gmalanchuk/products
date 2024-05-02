<?php

namespace App\Services;

use App\Jobs\ProductCreatedJob;
use Illuminate\Support\Str;

class ProductService
{
    private array $data;

    public function createProduct()
    {
        $user = auth()->user();

        $this->data['article'] = Str::random(10);
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
