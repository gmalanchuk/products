<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:10'],
            'status' => ['nullable', 'in:available,unavailable'],
            'images' => ['nullable', 'array', 'min:1', 'max:3'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png'],
        ];
    }
}
