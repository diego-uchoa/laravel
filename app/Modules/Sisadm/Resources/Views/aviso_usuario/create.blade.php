@extends('sisadm::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisadm::aviso_usuario.create') !!}

@endsection


@section('page-header')
	Criar Novo - Aviso Usuário
@endsection

@section('content')

    {!! Form::open(['route'=>'sisadm::aviso_usuario.store']) !!}

        @include('sisadm::aviso_usuario._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection