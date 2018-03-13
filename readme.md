# Portal de Sistemas - SPOA

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Portal de Sistemas que irá comportar os sistemas internos desenvolvidos pela SPOA-COGTI

## Tecnologia

- Docker
- Vagrant (Desenvolvimento) - Centos
- Laravel
- Adldap
- Postgres
- Redis
- Pgadmin

## Instalação de Ambiente

A instalação do ambiente pode ser encontrada no [Redmine-SPOA] (http://10.206.52.29:8081/)

## Banco de Dados (POSTGRES)

Banco de dados roda um container do POSTGRES

## Autenticação (LDAP/Interna)

O portal utiliza autenticação via LDAP e banco de dados.

## Comandos Importantes

cd /vagrant/laravel/laradock && docker-compose up -d nginx postgres pgadmin redis && docker-compose exec workspace bash

// PORTAL

php artisan migrate:refresh --seed

php artisan migrate:rollback

php artisan migrate --seed

php artisan make:migration create_users_table

php artisan cache:clear


//MODULOS

php artisan module:migrate:reset

php artisan module:list

php artisan make:module:migration Sisadm create_aviso_sistema_table

php artisan module:migrate:refresh --seed


php artisan module:migrate:refresh sisfone --seed

php artisan module:migrate:refresh sishelp --seed

php artisan make:module:policy sisfone TelefonePolicy

//Publicar assets no public

php artisan vendor:publish --tag=modules --force

//DEBUG

Debugbar::info($object);

//MODULO ESPECIFICO
php artisan migrate:refresh --seed && php artisan module:migrate:refresh siscontratos --seed && php artisan cache:clear

//TODOS MODULOS
php artisan migrate:refresh --seed && php artisan module:migrate:refresh --seed && php artisan cache:clear