<?php

namespace App\Policies;

use App\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy extends StandardPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->setModel('App\Models\Category');
    }
}
