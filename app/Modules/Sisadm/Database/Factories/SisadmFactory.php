<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Modules\Sisadm\Models\TipoAvisoSistema::class, function (Faker\Generator $faker) {
    return [
        'no_tipo_aviso_sistema' => $faker->word,
    ];
});

$factory->define(App\Modules\Sisadm\Models\TipoAvisoUsuario::class, function (Faker\Generator $faker) {
    return [
        'no_tipo_aviso_usuario' => $faker->word,
    ];
});

$factory->define(App\Modules\Sisadm\Models\AvisoSistema::class, function (Faker\Generator $faker) {
    return [
        'tx_aviso_sistema' => $faker->word,
        'id_tipo_aviso_sistema' => $faker->numberBetween(1,3),        
    ];
});

$factory->define(App\Modules\Sisadm\Models\AvisoUsuario::class, function (Faker\Generator $faker) {
    return [
        'tx_aviso_usuario' => $faker->word,
        'id_tipo_aviso_usuario'   => $faker->numberBetween(1,2),        
    ];
});