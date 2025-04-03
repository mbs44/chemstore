<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;

/**
 * abstract base class for all controllers that share some common functions
 */
abstract class Controller
{
    /**
     * check user is in given role
     * @param string $role
     * @return bool
     */
    protected static function userInRole ( string $role  ) : bool {
        // get roles from session
        $userRoles = session('user_roles', []);

        if (in_array($role, $userRoles, true))
            return true;

        return false;
    }

    /**
     * check user is in at least one role from the given list
     * @param array $roles
     * @return bool
     */
    protected function checkRoles ( array $roles  ) : bool {
        // get roles from session
        $userRoles = session('user_roles', []);
        foreach ($roles as $role) {
            if (in_array($role, $userRoles, true))
                return true;
        }
        return false;

    }

    /**
     * throws 403 if user is NOT in at least one role from the given list
     * @param array $roles
     * @return void
     * @throws AuthorizationException
     */
    protected function assertRoles ( array $roles ) : void {
        if ( ! $this->checkRoles($roles))
            throw new AuthorizationException('You do not have permission for this action.');
    }

}
