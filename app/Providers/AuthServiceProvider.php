<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin', function(User $user){
            return $user->role == 'admin';
        });

        Gate::define('kurikulum', function(User $user){
            return $user->role == 'kurikulum';
        });

        Gate::define('kaprog', function(User $user){
            return $user->role == 'kaprog';
        });

        Gate::define('kesiswaan', function(User $user){
            return $user->role == 'kesiswaan';
        });

        Gate::define('walas', function(User $user){
            return $user->role == 'walas';
        });

        Gate::define('guru', function(User $user){
            return $user->role == 'guru';
        });

        Gate::define('siswa', function(User $user){
            return $user->role == 'siswa';
        });
    }
}
