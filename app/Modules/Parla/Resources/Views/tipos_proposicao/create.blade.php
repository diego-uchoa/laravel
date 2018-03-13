@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::tiposProposicao.create') !!}

@endsection

@section('page-header')
    Criar Novo - Tipo Proposicao
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::tiposProposicao.store']) !!}

        @include('parla::tiposProposicao._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection