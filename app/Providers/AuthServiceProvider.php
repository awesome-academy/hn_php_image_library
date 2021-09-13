<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('category', function ($user) {
            return $user->hasPermission('category');
        });
        Gate::define('user', function ($user) {
            return $user->hasPermission('user');
        });
        Gate::define('subcategory', function ($user) {
            return $user->hasPermission('subcategory');
        });
        Gate::define('permission', function ($user) {
            return $user->hasPermission('permission');
        });
        Gate::define('role', function ($user) {
            return $user->hasPermission('role');
        });
        Gate::define('image', function ($user) {
            return $user->hasPermission('image');
        });
    }
}
