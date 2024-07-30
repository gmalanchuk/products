<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;


/**
 * Class AdminOwnerPolicy
 *
 * The policy methods within this class check if the user performing
 * the action is either an admin or the owner of the model.
 *
 * @package App\Policies
 */
class AdminOwnerPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $model): bool | Response
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->id === $model->user_id) {
            return true;
        }

        return Response::deny('You can\'t update this item because you are not the owner');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, $model): bool | Response
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->id === $model->user_id) {
            return true;
        }

        return Response::deny('You can\'t delete this item because you are not the owner');
    }
}
