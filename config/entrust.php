<?php

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Entrust Role Model
    |--------------------------------------------------------------------------
    |
    | This is the Role model used by Entrust to create correct relations.  Update
    | the role if it is in a different namespace.
    |
    */
    //'role' => 'App\Role',
    'role' => 'App\Modules\Sisadm\Models\Perfil',

    /*
    |--------------------------------------------------------------------------
    | Entrust Roles Table
    |--------------------------------------------------------------------------
    |
    | This is the roles table used by Entrust to save roles to the database.
    |
    */
    //'roles_table' => 'roles',
    'roles_table' => 'spoa_portal.perfil',

    /*
    |--------------------------------------------------------------------------
    | Entrust Permission Model
    |--------------------------------------------------------------------------
    |
    | This is the Permission model used by Entrust to create correct relations.
    | Update the permission if it is in a different namespace.
    |
    */
    //'permission' => 'App\Permission',
    'permission' => 'App\Modules\Sisadm\Models\Operacao',

    /*
    |--------------------------------------------------------------------------
    | Entrust Permissions Table
    |--------------------------------------------------------------------------
    |
    | This is the permissions table used by Entrust to save permissions to the
    | database.
    |
    */
    //'permissions_table' => 'permissions',
    'permissions_table' => 'spoa_portal.operacao',

    /*
    |--------------------------------------------------------------------------
    | Entrust permission_role Table
    |--------------------------------------------------------------------------
    |
    | This is the permission_role table used by Entrust to save relationship
    | between permissions and roles to the database.
    |
    */
    //'permission_role_table' => 'permission_role',
    'permission_role_table' => 'spoa_portal.perfil_operacao',

    /*
    |--------------------------------------------------------------------------
    | Entrust role_user Table
    |--------------------------------------------------------------------------
    |
    | This is the role_user table used by Entrust to save assigned roles to the
    | database.
    |
    */
    //'role_user_table' => 'role_user',
    'role_user_table' => 'spoa_portal.usuario_perfil',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on Entrust's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    //'user_foreign_key' => 'user_id',
    'user_foreign_key' => 'id_usuario',

    /*
    |--------------------------------------------------------------------------
    | Role Foreign key on Entrust's role_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    //'role_foreign_key' => 'role_id',
    'role_foreign_key' => 'id_perfil',

];
