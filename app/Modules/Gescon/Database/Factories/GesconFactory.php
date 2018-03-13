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

$factory->define(App\Modules\Gescon\Models\Modalidade::class, function (Faker\Generator $faker) {
    return [
        'no_modalidade' => $faker->word,
    ];
});

$factory->define(App\Modules\Gescon\Models\Edificio::class, function (Faker\Generator $faker) {
    return [
        'co_edificio' => $faker->name,
        'no_edificio' => $faker->name,
        'sg_uf' => 'DF',
    ];
});

$factory->define(App\Modules\Gescon\Models\IndiceVariacao::class, function (Faker\Generator $faker) {
    return [
        'sg_indice_variacao' => $faker->name,
    ];
});

$factory->define(App\Modules\Gescon\Models\TipoItemContratacao::class, function (Faker\Generator $faker) {
    return [
        'in_objeto' => 'TR',
        'ds_tipo_item_contratacao' => $faker->name,
    ];
});
