<?php

namespace App\Policies;

use App\User;
use App\Models\Resource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any resources.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function view(User $user, Resource $resource)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function update(User $user, Resource $resource)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function delete(User $user, Resource $resource)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can restore the resource.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function restore(User $user, Resource $resource)
    {
        return $user->is_super;
    }

    /**
     * Determine whether the user can permanently delete the resource.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function forceDelete(User $user, Resource $resource)
    {
        return $user->is_super;
    }
}
