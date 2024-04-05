<?php

namespace App\Services;

class ProductService
{
    private array $data;

    public function createProduct()
    {
        $product = auth()->user()->products()->create($this->data);
        return $product;
    }

    public function setData(array $data): ProductService
    {
        $this->data = $data;
        return $this;
    }
}
