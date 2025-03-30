<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    public static function currentLanguage(Request $request) : string
    {
        // Get the current language from the session
        return $request->session()->get('language', 'en'); // Default to English

    }

    //
}
