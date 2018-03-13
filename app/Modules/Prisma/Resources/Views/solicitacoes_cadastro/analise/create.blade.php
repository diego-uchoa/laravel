@extends('prisma::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('prisma::solicitacoes_cadastro.create') !!}

@endsection

@section('page-header')
    Criar Novo - Solicitacao Cadastro
@endsection

@section('content')

    {!! Form::open(['route'=>'prisma::solicitacoes_cadastro.store']) !!}

        @include('prisma::solicitacoes_cadastro._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection