<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    //use the before function to remove restrictions for admins. Always first function in policy
    public function before(User $user)
    {
        if($user->isAdmin()) {
            return true;
        }
        return null;
    }

       public function view(?User $user, Listing $listing): bool
    {
        return $listing->user->role !== 'suspended' && $listing->approved;
    }


    public function create(User $user): bool
    {
        return $user->role !== 'suspended';
    }

    public function modify(User $user, Listing $listing): bool
    {
        return $user->role !== 'suspended' && $listing->user_id === $user->id  ;
    }

    public function approve(User $user, Listing $listing)
    {
        return $user->idAdmin();
    }
}
