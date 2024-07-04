<?php

namespace App\Services;

use App\Jobs\ProductCreatedJob;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    private array $data;

    public function createProduct()
    {
        $user = auth()->user();

        $images = Arr::get($this->data, 'images');
        unset($this->data['images']);

        $this->data['article'] = Str::random(8);
        $product = $user->products()->create($this->data);

        // todo S3 storage
        if (!empty($images)) {
            foreach ($images as $image) {
                $path = $image->storePublicly('images');
                $product->images()->create([
                    'url' => config('app.url') . Storage::url($path),
                ]);
            }
        }

        ProductCreatedJob::dispatch($product, $user);

        return $product;
    }

    public function updateProduct($product)
    {
        $images = Arr::get($this->data, 'images');

        // todo S3 storage
        if (!empty($images)) {
            $product->images()->delete();
            foreach ($images as $image) {
                $path = $image->storePublicly('images');
                $product->images()->create([
                    'url' => config('app.url') . Storage::url($path),
                ]);
            }
        }

        $product->update($this->data);
        return $product;
    }

    public function setData(array $data): ProductService
    {
        $this->data = $data;
        return $this;
    }
}
