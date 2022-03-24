<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCharacteristicPolicy extends StandardPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setModel('App\Models\ProductCharacteristic');
    }
}
