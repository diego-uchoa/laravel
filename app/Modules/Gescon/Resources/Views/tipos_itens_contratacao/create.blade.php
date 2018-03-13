@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::tipos_itens_contratacao.create') !!}

@endsection

@section('page-header')
    Criar Novo - Objeto de Contratação
@endsection

@section('content')

    {!! Form::open(['route'=>'gescon::tipos_itens_contratacao.store']) !!}

        @include('gescon::tipos_itens_contratacao._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection