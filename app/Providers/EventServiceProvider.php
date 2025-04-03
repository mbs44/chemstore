<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use App\Listeners\LoadUserRoles;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * register specific event listeners
 */
class EventServiceProvider extends ServiceProvider {
    // register successful authentication listener
    protected $listen = [
        Authenticated::class => [
            LoadUserRoles::class,
        ],
    ];
}
