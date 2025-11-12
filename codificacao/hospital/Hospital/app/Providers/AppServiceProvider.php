<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Gate::define('adm',function(User $user){
            return $user->perfil === 'admin';
        });
        Gate::define('medico',function(User $user){
            return $user->perfil === 'medico';
        });
        Gate::define('farmaceutico',function(User $user){
            return $user->perfil === 'farmaceutico';
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
