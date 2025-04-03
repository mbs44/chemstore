<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // create global variable available in all blade templates that contains current language flag taken from session
        View::composer('*', function ($view) {
            $view->with('isEnglish', Session::get('language', 'en') === 'en'); // Default to 'en' if not set
        });
    }
}
