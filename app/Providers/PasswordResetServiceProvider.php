<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\PasswordBrokerManager as PasswordBrokerManagerPortal;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider as PasswordResetServiceProviderLaravel;

class PasswordResetServiceProvider extends PasswordResetServiceProviderLaravel
{
    /**
     * Register the password broker instance.
     *
     * @return void
     */
    protected function registerPasswordBroker()
    {
        $this->app->singleton('auth.password', function ($app) {
            return new PasswordBrokerManagerPortal($app);
        });

        $this->app->bind('auth.password.broker', function ($app) {
            return $app->make('auth.password')->broker();
        });
    }

}
