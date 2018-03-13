<?php

namespace App\Modules\PrismaBi\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'prisma-bi');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'prisma-bi');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'prisma-bi');
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
