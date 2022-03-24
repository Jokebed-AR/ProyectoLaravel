<?php

namespace App\Policies;

use App\Models\CatalogDownload;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogDownloadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CatalogDownload  $catalogDownload
     * @return mixed
     */
    public function view(User $user, CatalogDownload $catalogDownload)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CatalogDownload  $catalogDownload
     * @return mixed
     */
    public function update(User $user, CatalogDownload $catalogDownload)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CatalogDownload  $catalogDownload
     * @return mixed
     */
    public function delete(User $user, CatalogDownload $catalogDownload)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CatalogDownload  $catalogDownload
     * @return mixed
     */
    public function restore(User $user, CatalogDownload $catalogDownload)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\CatalogDownload  $catalogDownload
     * @return mixed
     */
    public function forceDelete(User $user, CatalogDownload $catalogDownload)
    {
        return false;
    }
}
