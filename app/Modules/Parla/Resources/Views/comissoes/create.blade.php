@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::comissoes.create') !!}

@endsection

@section('page-header')
    Criar Novo - Comissao
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::comissoes.store']) !!}

        @include('parla::comissoes._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection