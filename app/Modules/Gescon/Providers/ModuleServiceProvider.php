<?php

namespace App\Modules\Gescon\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'gescon');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'gescon');
        
        //COMENTADO - RODA MIGRATE INDIVIDUAL
        //$this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'gescon');
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
