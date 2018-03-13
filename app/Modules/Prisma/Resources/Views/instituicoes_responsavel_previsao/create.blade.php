@extends('prisma::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('prisma::instituicoes_responsavel_previsao.create') !!}

@endsection

@section('page-header')
    Criar Novo - Instituicao Responsavel Previsao
@endsection

@section('content')

    {!! Form::open(['route'=>'prisma::instituicoes_responsavel_previsao.store']) !!}

        @include('prisma::instituicoes_responsavel_previsao._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection