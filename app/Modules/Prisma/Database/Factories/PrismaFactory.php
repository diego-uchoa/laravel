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

$factory->define(App\Modules\Prisma\Models\SolicitacaoCadastro::class, function (Faker\Generator $faker) {
    return [
        'nr_cnpj'   =>  $faker->name,
        'no_razao_social'   =>  $faker->name,
        'no_relatorio'   =>  $faker->name,
        'no_situacao' =>  $faker->name,
        'nr_telefone'   =>  $faker->name,
        'ds_email'   =>  $faker->name,
        'ed_cep_logradouro'   =>  $faker->name,
        'ed_logradouro'   =>  $faker->name,
        'ed_numero_logradouro'   =>  $faker->name,
        'ed_complemento_logradouro'   =>  $faker->name,
        'ed_bairro_logradouro'   =>  $faker->name,
        'ed_municipio_logradouro'   =>  $faker->name,
        'ed_sigla_uf'   =>  $faker->name,
        'nr_cpf_responsavel'   =>  $faker->name,
        'no_responsavel'   =>  $faker->name,
        'nr_telefone_responsavel'   =>  $faker->name,
        'ds_email_responsavel'   =>  $faker->name,
        'no_cargo_responsavel'   =>  $faker->name,
        'in_situacao_solicitacao'   =>  $faker->name,
    ];
});

$factory->define(App\Modules\Prisma\Models\SolicitacaoCadastroEditor::class, function (Faker\Generator $faker) {
    return [
        'nr_cpf'   =>  $faker->name,
        'no_editor'   =>  $faker->name,
        'ds_email'   =>  $faker->name,
        'nr_telefone'   =>  $faker->name,
        'id_solicitacao_cadastro'   =>  $faker->name,
    ];
});


$factory->define(App\Modules\Prisma\Models\Instituicao::class, function (Faker\Generator $faker) {
    return [
        'nr_cnpj'   =>  $faker->name,
        'no_razao_social'   =>  $faker->name,
        'no_relatorio'   =>  $faker->name,
        'no_situacao' =>  $faker->name,
        'nr_telefone'   =>  $faker->name,
        'ds_email'   =>  $faker->name,
        'ed_cep_logradouro'   =>  $faker->name,
        'ed_logradouro'   =>  $faker->name,
        'ed_numero_logradouro'   =>  $faker->name,
        'ed_complemento_logradouro'   =>  $faker->name,
        'ed_bairro_logradouro'   =>  $faker->name,
        'ed_municipio_logradouro'   =>  $faker->name,
        'ed_sigla_uf'   =>  $faker->name,
        'nr_cpf_responsavel'   =>  $faker->name,
        'no_responsavel'   =>  $faker->name,
        'nr_telefone_responsavel'   =>  $faker->name,
        'ds_email_responsavel'   =>  $faker->name,
        'no_cargo_responsavel'   =>  $faker->name,
        'id_solicitacao_cadastro' =>  $faker->name
    ];
});