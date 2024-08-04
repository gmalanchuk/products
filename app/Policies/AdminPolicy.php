<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    public function changeRole(User $currentUser, User $targetUser): Response
    {
        if ($targetUser->role === 'admin' && $targetUser->changed_by === null) {
            return Response::deny('You cannot change the role of this admin');
        } elseif ($targetUser->role === 'admin' && $targetUser->changed_by !== $currentUser->id) {
            return Response::deny("You can't change this user's role, since you're not the one who made him an administrator");
        }

        return Response::allow();
    }
}
