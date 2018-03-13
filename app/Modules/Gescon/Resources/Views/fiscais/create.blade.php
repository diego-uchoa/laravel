@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::fiscais.create') !!}

@endsection

@section('page-header')
    Criar Novo - Fiscal
@endsection

@section('content')

    {!! Form::open(['route'=>'gescon::fiscais.store']) !!}

        @include('gescon::fiscais._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection