<?php

namespace App\Policies;

use App\Models\Church;
use App\Models\User;

class ChurchPolicy
{
    /**
     * Anyone (including guests) can view the list.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Anyone can view a single church.
     */
    public function view(?User $user, Church $church): bool
    {
        return true;
    }

    /**
     * Only authenticated users can create.
     */
    public function create(?User $user): bool
    {
        return !is_null($user);
    }

    /**
     * Only authenticated users can update.
     * (We’ll refine ownership/admin later in the Roles module.)
     */
    public function update(?User $user, Church $church): bool
    {
        return !is_null($user);
    }

    /**
     * Only authenticated users can delete.
     */
    public function delete(?User $user, Church $church): bool
    {
        return !is_null($user);
    }
}
