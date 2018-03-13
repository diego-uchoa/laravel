@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::contratantes.create') !!}

@endsection

@section('page-header')
    Criar Novo - Contratante
@endsection

@section('content')

    {!! Form::open(['route'=>'gescon::contratantes.store', 'id' => 'formulario']) !!}

        @include('gescon::contratantes._form_create',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection