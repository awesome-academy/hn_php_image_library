<?php

namespace App\Providers;

use App\Models\Category;
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
        $this->app->singleton(
            \App\Repositories\Interfaces\CategoryRepositoryInterface::class,
            \App\Repositories\Eloquent\CategoryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\CommentRepositoryInterface::class,
            \App\Repositories\Eloquent\CommentRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\ImageRepositoryInterface::class,
            \App\Repositories\Eloquent\ImageRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\FollowRepositoryInterface::class,
            \App\Repositories\Eloquent\FollowRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\PermissionRepositoryInterface::class,
            \App\Repositories\Eloquent\PermissionRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\RoleRepositoryInterface::class,
            \App\Repositories\Eloquent\RoleRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\Eloquent\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['frontend.partial.header'], function () {
            $categories = Category::where('parent_id', null)->get();
            $var['categories'] = $categories;
            view()->share($var);
        });
    }
}
