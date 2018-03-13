<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path' => [

        'migration'         => 'Database/migrations/',

        'model'             => 'Models/',

        'repository'        => 'Repositories/',

        'routes'            => 'Routes/web.php',

        'api_routes'        => 'routes/api.php',

        'request'           => 'Http/Requests/',

        'api_request'       => 'Http/Requests/API/',

        'controller'        => 'Http/Controllers/',

        'api_controller'    => 'Http/Controllers/API/',

        'test_trait'        => 'Tests/traits/',

        'repository_test'   => 'Tests/',

        'api_test'          => 'Tests/',

        'views'             => 'Resources/Views/',

        'schema_files'      => 'Resources/Model_schemas/',

        'templates_dir'     => 'Resources/infyom/infyom-generator-templates/',

        'modelJs'           => 'Assets/js/models/',

        'module'            => app_path('Modules/'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace' => [

        'model'             => 'Models',

        'datatables'        => 'DataTables',

        'repository'        => 'Repositories',

        'controller'        => 'Http\Controllers',

        'api_controller'    => 'Http\Controllers\API',

        'request'           => 'Http\Requests',

        'api_request'       => 'Http\Requests\API',

        'module'            => 'App\Modules',
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    */

    'templates'         => 'laravel-generator',

    /*
    |--------------------------------------------------------------------------
    | Model extend class
    |--------------------------------------------------------------------------
    |
    */

    'model_extend_class' => 'Eloquent',
    'model_base_class' => 'App\Models\BaseModel',
    'model_audit_class' => 'App\Models\AuditModel',

    /*
    |--------------------------------------------------------------------------
    | API routes prefix & version
    |--------------------------------------------------------------------------
    |
    */

    'api_prefix'  => 'api',

    'api_version' => 'v1',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options' => [

        'softDelete' => true,

        'tables_searchable_default' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes
    |--------------------------------------------------------------------------
    |
    */

    'prefixes' => [

        'route' => '',  // using admin will create route('admin.?.index') type routes

        'path' => '',

        'view' => '',  // using backend will create return view('backend.?.index') type the backend views directory

        'public' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Add-Ons
    |--------------------------------------------------------------------------
    |
    */

    'add_on' => [

        'swagger'       => false,

        'tests'         => false,

        'datatables'    => false,

        'menu'          => [

            'enabled'       => false,

            'menu_file'     => 'layouts/menu.blade.php',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Timestamp Fields
    |--------------------------------------------------------------------------
    |
    */

    'timestamps' => [

        'enabled'       => true,

        'created_at'    => 'created_at',

        'updated_at'    => 'updated_at',

        'deleted_at'    => 'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Save model files to `App/Models` when use `--prefix`. see #208
    |--------------------------------------------------------------------------
    |
    */
    'ignore_model_prefix' => false,

];
