<?php

namespace App\Policies;

use App\User;
use App\Models\Banner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any attributes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Banner  $banner
     * @return mixed
     */
    public function view(User $user, Banner $banner)
    {
        return true;
    }

    /**
     * Determine whether the user can create attributes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Banner  $banner
     * @return mixed
     */
    public function update(User $user, Banner $banner)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Banner  $banner
     * @return mixed
     */
    public function delete(User $user, Banner $banner)
    {
        $firstBanner = Banner::first();
        if($firstBanner != null)
            return $firstBanner->id != $banner->id;
        return true;
    }

    /**
     * Determine whether the user can restore the attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Banner  $banner
     * @return mixed
     */
    public function restore(User $user, Banner $banner)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the attribute.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Banner  $banner
     * @return mixed
     */
    public function forceDelete(User $user, Banner $banner)
    {
        return false;
    }
}
