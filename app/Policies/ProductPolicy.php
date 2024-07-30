<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;


class ProductPolicy extends BasePolicy
{
    public function view(?User $user, Product $product): Response
    {
        if ($product->status === 'available') {
            return Response::allow();
        }
        return $this->onlyOwnerOrAdmin($user, $product, 'view');
    }

    public function update(User $user, Product $product): Response
    {
        return $this->onlyOwnerOrAdmin($user, $product, 'update');
    }

    public function delete(User $user, Product $product): Response
    {
        return $this->onlyOwnerOrAdmin($user, $product, 'delete');
    }
}
