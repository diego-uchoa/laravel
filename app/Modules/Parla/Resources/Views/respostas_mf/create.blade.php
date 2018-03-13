@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::respostas_mf.create') !!}

@endsection

@section('page-header')
    Criar Novo - Resposta Mf
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::respostas_mf.store']) !!}

        @include('parla::respostas_mf._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection