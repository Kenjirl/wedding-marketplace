<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('wedding-couple', function(User $user) {
            return $user->role === 'wedding-couple';
        });

        Gate::define('wedding-organizer', function(User $user) {
            return $user->role === 'wedding-organizer';
        });

        Gate::define('wedding-photographer', function(User $user) {
            return $user->role === 'wedding-photographer';
        });
    }
}
