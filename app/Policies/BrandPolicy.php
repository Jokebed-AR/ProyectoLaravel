<?php

namespace App\Policies;

use App\Models\Resource;
use App\User;
use App\Models\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy extends StandardPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->setModel('App\Models\Brand');
    }
}
