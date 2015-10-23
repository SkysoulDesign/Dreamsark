<?php

namespace DreamsArk\Policies;

use DreamsArk\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function executeArtisanCommands(User $user)
    {
        return ($user->id == 1 || $user->id == 3);
    }

}
