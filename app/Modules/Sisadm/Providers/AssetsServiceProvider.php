<?php

namespace App\Modules\Sisadm\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                __DIR__.'/../Assets' => public_path('modules/sisadm'),
            ], 'modules');
    }

}
