<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Authenticated;

class LoadUserRoles
{

    public function handle(Authenticated $event): void
    {

        // Get the authenticated user
        $user = $event->user;
        $uid = $user->uid[0];

        $dbUser = User::query()->where('username', $uid)->first();

        $roles = [];
        if ( $dbUser) {
            if ($dbUser->is_admin)
                $roles[] = 'admin';

            if ($dbUser->is_teacher)
                $roles[] = 'teacher';

            if ($dbUser->is_student)
                $roles[] = 'student';
        } else {
            $roles[] = 'student';
            User::create([
                'username' => $uid,
                'is_admin' => false,
                'is_teacher' => false,
                'is_student' => true,
                'email' => $uid . "@gjh.sk",
            ]);
        }

        if ( !$roles)
            throw new AuthorizationException('You do not have permission for this application.');
        // Optionally, you can assign roles to the session
        session(['user_roles' => $roles]);
    }
}
