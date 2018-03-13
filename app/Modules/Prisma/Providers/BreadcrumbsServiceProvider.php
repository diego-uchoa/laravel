<?php

namespace App\Modules\Prisma\Providers;

use DaveJamesMiller\Breadcrumbs\ServiceProvider;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function registerBreadcrumbs()
    {
        require (__DIR__.'/../Http/Breadcrumbs/breadcrumbs.php');	
    }
}