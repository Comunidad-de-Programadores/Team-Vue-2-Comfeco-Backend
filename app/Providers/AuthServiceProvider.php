<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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

        Passport::tokensCan([
            'app-client-guest' => 'Para que los usuarios puedan consumir sin logearse',
            'app-client-logged' => 'Para que los usuarios puedan consumir cuando ya se logearon'
        ]);

        Route::prefix('api')->group(function () {
            Passport::routes();
        });
        // Passport::routes();
    }
}
