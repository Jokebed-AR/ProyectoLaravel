<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    //

    use SoftDeletes;

    public function resources()
    {
        return $this->belongsToMany(Resource::class)
                    ->using(ResourceGroup::class)
                    ->withPivot('create', 'read', 'update', 'delete', 'restore');
    }

    public function resourceWithPermissionGiven($resource, $permission)
    {
        return $this->belongsToMany(Resource::class)
                ->using(ResourceGroup::class)
                ->where('resource_id', $resource)
                ->withPivot($permission)
                ->get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(GroupUser::class);
    }

    public static function createGroups(){
        return "creando grupo";
    }
}
