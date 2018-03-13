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

$factory->define(App\Modules\Sisfone\Models\TipoTelefone::class, function (Faker\Generator $faker) {
    return [
        'no_tipo_telefone' => $faker->randomElement(array('FIXO', 'CEL', 'FAX')),
    ];
});


$factory->define(App\Modules\Sisfone\Models\Telefone::class, function (Faker\Generator $faker) {
    return [
        'tx_telefone' => $faker->numerify('(##) ####-#####'),
        'sn_principal' => false,
        'id_tipo_telefone' => rand(1,3),
        'id_usuario' => rand(1,3)
    ];
});
