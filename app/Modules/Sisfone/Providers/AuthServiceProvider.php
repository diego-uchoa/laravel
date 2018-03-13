<?php

namespace App\Modules\Sisfone\Providers;


use App\Modules\Sisfone\Models\Telefone;
use App\Modules\Sisfone\Policies\TelefonePolicy;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Telefone::class => TelefonePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->before(function($usuario) {
             if($usuario->hasPerfil('SISFONE-Administrador')) {
               return true;
             }
        });
    }
}