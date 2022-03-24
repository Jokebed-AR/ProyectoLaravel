<?php

namespace App\Policies;

use App\User;
use App\Models\Option;
use Illuminate\Auth\Access\HandlesAuthorization;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any options.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the option.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Option  $option
     * @return mixed
     */
    public function view(User $user, Option $option)
    {
        return true;
    }

    /**
     * Determine whether the user can create options.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the option.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Option  $option
     * @return mixed
     */
    public function update(User $user, Option $option)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the option.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Option  $option
     * @return mixed
     */
    public function delete(User $user, Option $option)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the option.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Option  $option
     * @return mixed
     */
    public function restore(User $user, Option $option)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the option.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Option  $option
     * @return mixed
     */
    public function forceDelete(User $user, Option $option)
    {
        return false;
    }
}
