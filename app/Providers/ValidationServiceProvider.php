<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $this->app['validator']->extend('composite_unique', function ($attribute, $value, $parameters, $validator) {
            // Custom validation logic

            // Clean the parameters
            $parameters = array_map( 'trim', $parameters );

            // remove first parameter and assume it is the table name
            $table = array_shift( $parameters ); 

            // start building the conditions
            $value = preg_replace("/[^0-9]/", "", $value);
            $fields[] = [ $attribute, '=', $value ]; // current field, company_code in your case

            // iterates over the other parameters and build the conditions for all the required fields
            while ( $field = array_shift( $parameters ) ) {
                
                if ($field == $attribute) continue; //Check if the attribute passed in the parameter
                
                $t = explode(':', $field); //extract parameters that have value 

                // Check if the parameter passed with value
                if(isset($t[1])){
                    if ($t[1] == 'pk'){
                        if (\Request::get($t[0]) != ''){
                            $fields[] = [ $t[0], '<>', \Request::get( $t[0] ) ];    
                        }
                    }
                    else{
                        $fields[] = [ $t[0], '=', \Request::get( $t[0] ) ];
                    }
                }
                else{
                    $fields[] = [ $field, '=', \Request::get($field) ];
                }

                //$fields[ $field ] = \Request::get( $field ); // using Request facade
            }

            \Log::info($fields);

            // query the table with all the conditions
            $result = \DB::table( $table )->select( \DB::raw( 1 ) )->where( $fields )->first();

            return empty( $result ); 
            
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}