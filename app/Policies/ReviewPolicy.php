<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool | Response
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->id === $review->user_id) {
            return true;
        }

        return Response::deny('You can\'t update this review because you are not the owner of this review');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool | Response
    {
        if ($user->role === 'admin') {
            return true;
        } elseif ($user->id === $review->user_id) {
            return true;
        }

        return Response::deny('You can\'t delete this review because you are not the owner of this review');
    }
}
