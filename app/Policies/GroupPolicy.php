<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy extends StandardPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->setModel('App\Models\Group');
    }
}
