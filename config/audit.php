<?php

/*
 * This file is part of laravel-auditing.
 *
 * @author Antério Vieira <anteriovieira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | User Model & Resolver
    |--------------------------------------------------------------------------
    |
    | Define the User model class and how to resolve a logged User ID.
    |
    */
    'user' => [
        'model'    => App\User::class,
        'resolver' => function () {
            return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
        },
    ],
    

    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | The default audit driver used to keep track of changes.
    |
    */
    'default' => 'database',


    /*
    |--------------------------------------------------------------------------
    | Audit Drivers
    |--------------------------------------------------------------------------
    |
    | Available audit drivers and respective configurations.
    |
    */
    'drivers' => [
        'database' => [
            'table'      => 'spoa_portal.audits',
            'connection' => null,
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Audit Console?
    |--------------------------------------------------------------------------
    |
    | Whether we should audit console events (eg. php artisan db:seed).
    |
    */
    'console' => false,
];
