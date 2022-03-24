<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeoPagePolicy extends StandardPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->setModel('App\Models\SeoPage');
    }
}
