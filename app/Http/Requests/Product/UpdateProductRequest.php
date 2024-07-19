<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:10'],
            'status' => ['nullable', 'in:available,unavailable'],
            'images' => ['nullable', 'array', 'min:1', 'max:3'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png'],
            'categories' => ['nullable', 'array', 'min:1', 'max:3'],
        ];
    }
}
