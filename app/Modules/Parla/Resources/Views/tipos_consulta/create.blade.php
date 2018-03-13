@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::tiposConsulta.create') !!}

@endsection

@section('page-header')
    Criar Novo - Tipo Consulta
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::tiposConsulta.store']) !!}

        @include('parla::tiposConsulta._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection