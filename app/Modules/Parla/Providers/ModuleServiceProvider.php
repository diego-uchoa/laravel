<?php

namespace App\Modules\Parla\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'parla');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'parla');

        //COMENTADO - RODA MIGRATE INDIVIDUAL
        //$this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'parla');
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
