<?php

namespace App\Modules\Prisma\Providers;

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
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'prisma');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'prisma');
        // $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'prisma');
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

