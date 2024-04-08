<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class ProductPolicy
{
    public function update(User $user, Product $product): bool | Response
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->id === $product->user_id) {
            return true;
        }

        return Response::deny('You can\'t update this product because you are not the owner of this product');
    }

    public function delete(User $user, Product $product): bool | Response
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->id === $product->user_id) {
            return true;
        }

        return Response::deny('You can\'t delete this product because you are not the owner of this product');
    }
}
