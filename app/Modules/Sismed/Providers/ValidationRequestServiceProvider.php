<?php

namespace App\Modules\Sismed\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

use App\Modules\Sismed\Models\Servidor;
use MaskHelper;

class ValidationRequestServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('uniquecpfservidor',function($attribute, $value, $parameters, $validator)
        {

            return (!(Servidor::where('nr_cpf',MaskHelper::removeMascaraCpf($value))->count() > 0));
            
        });

    }

}
