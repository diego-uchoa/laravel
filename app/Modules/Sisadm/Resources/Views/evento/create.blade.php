@extends('sisadm::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisadm::evento.create') !!}

@endsection


@section('page-header')
	Criar Novo - Evento
@endsection

@section('content')

    {!! Form::open(['route'=>'sisadm::evento.store']) !!}

        @include('sisadm::evento._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection