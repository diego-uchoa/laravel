@extends('sisfone::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisfone::telefone.create') !!}

@endsection

@section('page-header')
	Criar Novo - Telefone
@endsection

@section('content')

    {!! Form::open(['route'=>'sisfone::telefone.store']) !!}

        @include('sisfone::telefone._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection