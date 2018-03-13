@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::proposicoes.create') !!}

@endsection

@section('page-header')
    Adicionar Proposição
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::proposicoes.store']) !!}

        @include('parla::proposicoes._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection