@extends('sisadm::layouts.master')


@section('breadcrumbs-page')
	
	{!! Breadcrumbs::render('sisadm::sistemas.create') !!}

@endsection


@section('page-header')
	Criar Novo - Sistema
@endsection


@section('content')

	{!! Form::open(['route'=>'sisadm::sistemas.store']) !!}

        @include('sisadm::sistemas._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}    	

@endsection