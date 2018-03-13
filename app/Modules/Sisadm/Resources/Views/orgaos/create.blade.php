@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::orgaos.create') !!}

@endsection

@section('page-header')
    Criar Novo - Orgao
@endsection

@section('content')

    {!! Form::open(['route'=>'sisadm::orgaos.store']) !!}

        @include('sisadm::orgaos._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection