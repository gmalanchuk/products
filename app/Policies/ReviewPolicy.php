<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy extends BasePolicy
{
    public function update(User $user, Review $review): Response
    {
        return $this->onlyOwner($user, $review, 'update');
    }
}
