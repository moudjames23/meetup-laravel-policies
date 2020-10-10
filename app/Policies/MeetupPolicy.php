<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetupPolicy
{
    use HandlesAuthorization;

    public function see(User $user)
    {
        if($user->hasPermission('view_all_meetup'))
            return true;;

        return false;
    }

    public function create(User $user)
    {
        if($user->hasPermission('create_meetup'))
            return true;

        return false;
    }

    public function show(User $user)
    {
        if($user->hasPermission('show_meetup'))
            return true;

        return false;
    }

    public function edit(User $user)
    {
        if($user->hasPermission('edit_all_meetup'))
            return true;

        return false;
    }
}
