<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('reject-request', function ($user) {
            return in_array($user->role, ['registrar', 'admin', 'cashier']);
        });

        Gate::define('approve-request', function ($user) {
            return in_array($user->role, ['registrar', 'admin']);
        });
        
        Gate::define('approve-request-payment', function ($user) {
            return in_array($user->role, ['cashier', 'admin']);
        });
        
        Gate::define('complete-request', function ($user) {
            return in_array($user->role, ['registrar', 'admin']);
        });
    }
}
