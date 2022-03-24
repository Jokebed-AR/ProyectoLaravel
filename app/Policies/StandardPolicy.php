<?php
namespace App\Policies;

use App\Models\Resource;
use App\User;

class StandardPolicy
{

    // This is the model that the police references
    protected $model = null;

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    protected function getResource()
    {
        if (Resource::where('namespace', $this->getModel())->exists()) {
            return Resource::where('namespace', $this->getModel())->first();
        }
        return null;
    }

    protected function hasPermissionInGroup($user, $permission)
    {
        if ($user->is_super) {
            return true;
        }

        $groups = $user->groups;

        foreach ($groups as $group) {

            $resourceId = null;

            if ($this->getResource() !== null) {
                $resourceId = $this->getResource()->id;
            }

            $resources = $group->resourceWithPermissionGiven($resourceId, $permission);

            foreach ($resources as $resource) {
                if ($resource->pivot[$permission]) {
                    return true;
                }
            }

        }

        return false;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $this->hasPermissionInGroup($user, 'read');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @return mixed
     * TODO make instance callable, now you cannot use that
     */
    public function view(User $user)
    {
        return $this->hasPermissionInGroup($user, 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->hasPermissionInGroup($user, 'create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @return mixed
     * TODO make instance callable
     */
    public function update(User $user)
    {
        return $this->hasPermissionInGroup($user, 'update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     * TODO make instance callable
     */
    public function delete(User $user)
    {
        return $this->hasPermissionInGroup($user, 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Brand  $brand
     * TODO make instance callable
     * @return mixed
     */
    public function restore(User $user)
    {
        return $this->hasPermissionInGroup($user, 'restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @return mixed
     * TODO make instance callable
     */
    public function forceDelete(User $user)
    {
        return $user->is_super;
    }
}
