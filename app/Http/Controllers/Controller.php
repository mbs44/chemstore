<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;

abstract class Controller
{
    protected static function userInRole ( string $role  ) : bool {
        $userRoles = session('user_roles', []);

        if (in_array($role, $userRoles, true))
            return true;

        return false;
    }

    protected function checkRoles ( array $roles  ) : bool {
        $userRoles = session('user_roles', []);
        foreach ($roles as $role) {
            if (in_array($role, $userRoles, true))
                return true;
        }
        return false;

    }

    protected function assertRoles ( array $roles ) : void {
        if ( ! $this->checkRoles($roles))
            throw new AuthorizationException('You do not have permission for this action.');
    }
    //
}
