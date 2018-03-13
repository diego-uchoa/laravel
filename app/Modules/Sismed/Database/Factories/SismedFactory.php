n<?php

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

$factory->define(App\Modules\Sismed\Models\Servidor::class, function (Faker\Generator $faker) {
    return [
        'nr_cpf'    => '11111111111',
        'ds_email'  => $faker->unique()->safeEmail,
        'no_servidor' => $faker->name,
        'dt_nascimento' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'in_sexo' => 'F',
        'tx_telefone_unidade' => $faker->numerify('(##) ####-#####'),
        'tx_telefone_celular' => $faker->numerify('(##) ####-#####'),
        'tx_telefone_residencial' => $faker->numerify('(##) ####-#####'),
        'nr_siape' => $faker->randomDigit,
        'no_cargo' => $faker->word,
        'nr_rg' => $faker->randomDigit,
        'no_orgao' => $faker->word,
        'no_unidade_lotacao'  => $faker->word,
        'no_unidade_exercicio'  => $faker->word,
        'in_regime_juridico' => $faker->word,
        'co_prontuario'  => '99A'
    ];
});

$factory->define(App\Modules\Sismed\Models\Atestado::class, function (Faker\Generator $faker) {
    return [
        'in_area_atendimento' => $faker->numberBetween(1,2),
        'in_tipo_afastamento' => $faker->numberBetween(1,2),
        'in_tipo_pericia' => $faker->numberBetween(1,2),
        'te_prazo' => $faker->numberBetween(1,30),
        'nr_crm' => $faker->randomDigit,
        'no_medico' => $faker->name,
        'dt_inicio_afastamento' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'dt_fim_afastamento' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d')
    ];
});

$factory->define(App\Modules\Sismed\Models\ControleProntuario::class, function (Faker\Generator $faker) {
    return [
        'nr_prontuario' => $faker->randomDigit,
        'in_letra_prontuario' => $faker->word
    ];
});


$factory->define(App\Modules\Sismed\Models\Pericia::class, function (Faker\Generator $faker) {
    return [
        'id_atestado' => $faker->numberBetween(1,2),
        'in_tipo_pericia' => $faker->numberBetween(1,2),
        'te_prazo' => $faker->numberBetween(1,30),
        'dt_inicio_afastamento' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'dt_fim_afastamento' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'in_situacao' => 'A'
    ];
});

$factory->define(App\Modules\Sismed\Models\ControleCiclo::class, function (Faker\Generator $faker) {
    return [
        'id_servidor' => 1,
        'id_atestado_origem' => 1,
        'dt_inicio_ciclo' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'dt_fim_ciclo' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'va_adicional_ciclo_anterior' => 0
    ];
});