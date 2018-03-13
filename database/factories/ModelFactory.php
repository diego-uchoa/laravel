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

//CARREGA FACTORY DOS MODULOS
foreach (Module::enabled() as $module) {
    $factory->load('app/Modules/'.$module['basename'].'/Database/Factories');
}

$factory->define(App\Modules\Sisadm\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'no_usuario' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Modules\Sisadm\Models\Perfil::class, function (Faker\Generator $faker) {
    return [
        'no_perfil' => $faker->word,
        'ds_perfil' => $faker->sentence,
    ];
});

$factory->define(App\Modules\Sisadm\Models\Sistema::class, function (Faker\Generator $faker) {
    return [
        'no_sistema' => $faker->word,
        'ds_sistema' => $faker->sentence,
        'tx_beneficio' => $faker->sentence,
        'tx_publico' => $faker->sentence,
        'co_esquema' => 'spoa_[sistema]',
        'sn_ativo' => true,
        'sn_tela_inicial' => true,
        'no_responsavel' => $faker->name,
        'tx_email_responsavel' => $faker->safeEmail,
    ];
});

$factory->define(App\Modules\Sisadm\Models\Area::class, function (Faker\Generator $faker) {
    return [
        'no_area' => $faker->word,
        'ds_area' => $faker->sentence,
    ];
});

$factory->define(App\Modules\Sisadm\Models\ItemMenu::class, function (Faker\Generator $faker) {
    return [
        'no_item_menu' => $faker->word,
        'rota' => $faker->word,
        'ordem' => $faker->randomDigit,
        'icon' => 'menu-icon glyphicon glyphicon-folder-open',
        'tipo' => 'raiz',
        'id_sistema' => $faker->randomDigit,        
        'id_item_menu_precedente' => null
    ];
});

$factory->define(App\Models\Uf::class, function (Faker\Generator $faker) {
    return [
        'id_uf' => $faker->word,
        'sg_uf' => $faker->word,
        'no_uf' => $faker->sentence,
    ];
});

$factory->define(App\Modules\Sisadm\Models\Operacao::class, function (Faker\Generator $faker) {
    return [
        'no_operacao' => $faker->word,
        'ds_operacao' => $faker->sentence,        
        'sn_favorita' => false,
    ];
});

$factory->define(App\Modules\Sisadm\Models\Feriado::class, function (Faker\Generator $faker) {
    return [
        'dt_feriado' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
        'no_feriado'   => $faker->word,
        'sn_fim_semana' => $faker->boolean(),
    ];
});


$factory->define(App\Modules\Sisadm\Models\Evento::class, function (Faker\Generator $faker) {
    return [
        'no_evento' => $faker->word,
        'dt_inicio' => $faker->dateTimeBetween('now', '+30 days'),
        'dt_fim' => $faker->dateTimeBetween('+30 days', '+60 days'),
        'sn_todo_dia' => $faker->boolean(),
        'tx_cor' => 'red',        
    ];
});