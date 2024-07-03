<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
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
        // Load helper files
        foreach (glob(app_path('Helpers') . '/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('id');

        Gate::define('wedding-couple', function(User $user) {
            return $user->role === 'wedding-couple';
        });

        Gate::define('wedding-organizer', function(User $user) {
            return $user->role === 'wedding-organizer';
        });

        Gate::define('wedding-photographer', function(User $user) {
            return $user->role === 'photographer';
        });

        Gate::define('catering', function(User $user) {
            return $user->role === 'catering';
        });

        Gate::define('venue', function(User $user) {
            return $user->role === 'venue';
        });

        Gate::define('admin', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('super-admin', function(User $user) {
            return $user->role === 'super-admin';
        });
    }
}
