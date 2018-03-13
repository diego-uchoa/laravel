@extends('sisadm::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisadm::feriado.create') !!}

@endsection


@section('page-header')
	Criar Novo - Feriado
@endsection

@section('content')

    {!! Form::open(['route'=>'sisadm::feriado.store']) !!}

        @include('sisadm::feriado._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection