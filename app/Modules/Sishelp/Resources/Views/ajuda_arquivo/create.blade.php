@extends('sishelp::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sishelp::ajuda_arquivo.create') !!}

@endsection


@section('page-header')
	Criar Novo - Ajuda Arquivo
@endsection

@section('content')

    {!! Form::open(array('route' => 'sishelp::ajuda_arquivo.store', 'files' => true)) !!}

        @include('sishelp::ajuda_arquivo._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection