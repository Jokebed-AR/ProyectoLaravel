<?php

namespace App\Policies;

use App\User;
use App\Models\LegalDocument;
use Illuminate\Auth\Access\HandlesAuthorization;

class LegalDocumentPolicy extends StandardPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->setModel('App\Models\StandardPolicy');
    }
}
