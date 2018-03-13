@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisadm::aviso_sistema.create') !!}

@endsection

@section('page-header')
	Criar Novo - Aviso Sistema
@endsection

@section('content')

    {!! Form::open(['route'=>'sisadm::aviso_sistema.store']) !!}

        @include('sisadm::aviso_sistema._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection