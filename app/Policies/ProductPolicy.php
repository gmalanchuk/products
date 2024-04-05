<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    public function update(User $user, Product $product): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->id === $product->user_id;
    }
}
