@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::tipos_situacao.create') !!}

@endsection

@section('page-header')
    Criar Novo - Tipo de Situação
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::tipos_situacao.store']) !!}

        @include('parla::tipos_situacao._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection