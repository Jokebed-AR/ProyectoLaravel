<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends StandardPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->setModel('App\User');
    }
}
