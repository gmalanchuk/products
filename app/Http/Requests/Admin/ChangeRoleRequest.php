<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role' => ['required', 'in:user,admin'],
        ];
    }
}
