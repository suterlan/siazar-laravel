<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class MacroableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Builder::macro('whereRelationIn', function ($relation, $column, $array){
        //     return $this->whereHas($relation, fn($q) => $q->whereIn($column, $array));
        // });
    }
}
