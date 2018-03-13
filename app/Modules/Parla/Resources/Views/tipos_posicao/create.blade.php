@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::tiposPosicao.create') !!}

@endsection

@section('page-header')
    Criar Novo - Tipo Posicao
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::tiposPosicao.store']) !!}

        @include('parla::tiposPosicao._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection