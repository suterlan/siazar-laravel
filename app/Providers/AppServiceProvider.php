<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        // Gate::define('admin', function(User $user){
        //     return $user->role;
        // });

        Builder::macro('whereRelationIn', function ($relation, $column, $array) {
            return $this->whereHas($relation, fn ($q) => $q->whereIn($column, $array));
        });
    }
}
