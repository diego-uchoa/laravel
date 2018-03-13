@extends('prisma::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('prisma::instituicoes.create') !!}

@endsection

@section('page-header')
    Criar Nova - Instituição
@endsection

@section('content')

    {!! Form::open(['route'=>'prisma::instituicoes.store']) !!}

        @include('prisma::instituicoes._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection