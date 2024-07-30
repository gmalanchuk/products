<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;


class BasePolicy
{
    public function onlyOwner(User $user, $model, string $action): Response
    {
        if ($user->id === $model->user_id) {
            return Response::allow();
        }
        return Response::deny("You can't {$action} this item because you don't have enough permissions");
    }

    public function onlyOwnerOrAdmin(User $user, $model, string $action): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        } elseif ($user->id === $model->user_id) {
            return Response::allow();
        }
        return Response::deny("You can't {$action} this item because you don't have enough permissions");
    }
}
