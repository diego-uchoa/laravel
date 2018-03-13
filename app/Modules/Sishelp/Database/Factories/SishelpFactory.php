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

$factory->define(App\Modules\Sishelp\Models\AjudaFaq::class, function (Faker\Generator $faker) {
    return [
        'tx_pergunta' => $faker->word,
        'tx_resposta' => $faker->text(500),        
        'id_sistema' => rand(1,3),
    ];
});


$factory->define(App\Modules\Sishelp\Models\AjudaArquivo::class, function (Faker\Generator $faker) {
    return [
        'no_ajuda_arquivo' => $faker->word,
        'no_ajuda_arquivo_original' => $faker->word,
        'no_ajuda_arquivo_fisico' => $faker->word,
        'id_sistema' => rand(1,3)
    ];
});

$factory->define(App\Modules\Sishelp\Models\AjudaGeral::class, function (Faker\Generator $faker) {
    return [
        'tx_ajuda_geral' => $faker->word,
        'id_sistema' => rand(1,3),
    ];
});
