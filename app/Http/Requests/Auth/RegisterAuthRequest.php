<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email'=> ['required', 'email', 'unique:users'],
            'password'=> ['required', 'string'],
            're-password' => ['required', 'same:password'],
        ];
    }
}
