<?php

namespace App\Modules\Sisadm\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'sisadm');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'sisadm');
        
        //COMENTADO - RODA MIGRATE INDIVIDUAL
        //$this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'sisadm');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(BreadcrumbsServiceProvider::class);
        $this->app->register(AssetsServiceProvider::class); 
    }
}
