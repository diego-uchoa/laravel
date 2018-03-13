@extends('sishelp::layouts.master')

@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sishelp::ajuda_arquivo.edit', $arquivo) !!}

@endsection


@section('page-header')
	Editar - Ajuda Arquivo 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$arquivo->no_ajuda_arquivo}}
    </small>
@endsection


@section('content')

    {!! Form::model($arquivo, ['route'=>['sishelp::ajuda_arquivo.update', $arquivo->id_ajuda_arquivo], 'method'=>'put']) !!}

        @include('sishelp::ajuda_arquivo._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection