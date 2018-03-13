<?php

namespace App\Modules\Sisfone\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'sisfone');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'sisfone');
        
        //COMENTADO - RODA MIGRATE INDIVIDUAL
        //$this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'sisfone');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);        
        $this->app->register(BreadcrumbsServiceProvider::class); 
        $this->app->register(AssetsServiceProvider::class); 
    }
}
