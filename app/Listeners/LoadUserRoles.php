<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Authenticated;

class LoadUserRoles
{

    public function handle(Authenticated $event): void
    {

        // Get the authenticated user
        $user = $event->user;

        $dbUser = User::query()->where('username', $user->uid)->first();

        $roles = [];
        if ( $dbUser) {
            if ($dbUser->isAdmin)
                $roles[] = 'admin';

            if ($dbUser->isTeacher)
                $roles[] = 'teacher';

            if ($dbUser->isStudent)
                $roles[] = 'student';
        } else
            $roles[] = 'student';

        // Optionally, you can assign roles to the session
        session(['user_roles' => $roles]);
    }
}
