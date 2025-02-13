<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
        
        Passport::tokensCan([
            'admin' => 'Admin privileges',  // Define your custom token abilities/scopes
            'user' => 'User privileges',    // Another example if needed
        ]);
    }
}

