<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;

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
       // Share $userType across all views
    View::composer('*', function ($view) {
        $user_details = Auth::user();
        if ($user_details) {
            $userType = $user_details->name;
            $view->with('userType', $userType);
        }
    });
    }
}
