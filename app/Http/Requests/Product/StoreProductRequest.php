<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:10'],
            'article' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'unique:products'],
            'status' => ['required', 'in:available,unavailable'],
        ];
    }
}
