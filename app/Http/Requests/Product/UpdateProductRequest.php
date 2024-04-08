<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:10'],
            'article' => ['nullable', 'regex:/^[a-zA-Z0-9]+$/', 'unique:products'],
            'status' => ['nullable', 'in:available,unavailable'],
        ];
    }
}
