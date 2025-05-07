<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Artist;
use App\Models\ReviewRating;
use Illuminate\Auth\Access\Response;

class ReviewRatingPolicy
{
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function modify(User $user, ReviewRating $reviewRating): Response
    {
        return $user->id === $reviewRating->user_id  
                ? Response::allow() 
                : Response::deny();
    }
}
