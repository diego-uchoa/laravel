<?php

namespace App\Modules\Sismed\Providers;

use DaveJamesMiller\Breadcrumbs\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function registerBreadcrumbs()
    {
        require (__DIR__.'/../Http/Breadcrumbs/breadcrumbs.php');	
    }
}