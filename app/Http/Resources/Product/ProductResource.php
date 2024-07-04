<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'article' => $this->article,
            'name' => $this->name,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'images' => $this->imagesList(),
            'categories' => $this->categoriesList(),
        ];
    }
}
