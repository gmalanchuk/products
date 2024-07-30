<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class ProductPolicy extends AdminOwnerPolicy
{
    public function view(?User $user, Product $product): bool | Response
    {
        return $user?->role === 'admin' || $product->status === 'available' || $user?->id === $product->user_id
            ? Response::allow()
            : Response::deny('Insufficient rights to view this product');
    }
}
