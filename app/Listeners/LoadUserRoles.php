<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Authenticated;

/**
 * Synchronizes internal users table with user data from LDAP
 */
class LoadUserRoles
{

    /**
     * executed as listener after successful authentication
     */
    public function handle(Authenticated $event): void
    {

        // Get the authenticated user
        $user = $event->user;
        // get the username from LDAP
        $uid = $user->getUserName();

        // search for username in the internal table
        $dbUser = User::query()->where('username', $uid)->first();

        $roles = [];
        // check user found in internal database
        if ( $dbUser) {
            // if user exists take his roles from users table
            if ($dbUser->is_admin)
                $roles[] = 'admin';

            if ($dbUser->is_teacher)
                $roles[] = 'teacher';

            if ($dbUser->is_student)
                $roles[] = 'student';
        } else {
            // if user is new create him in users table and set the default student role
            $roles[] = 'student';
            User::create([
                'username' => $uid,
                'is_admin' => false,
                'is_teacher' => false,
                'is_student' => true,
                'email' => $uid . "@gjh.sk",
            ]);
        }

        // user must have at least one role
        if ( !$roles)
            throw new AuthorizationException('You do not have permission for this application.');

        // assign roles to the session
        session(['user_roles' => $roles]);
    }
}
