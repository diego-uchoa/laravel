@extends('sisfone::layouts.master')

@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisfone::telefone.edit', $telefone) !!}

@endsection


@section('page-header')
	Editar - Telefone 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$telefone->usuario->no_usuario}}
    </small>
@endsection


@section('content')

    {!! Form::model($telefone, ['route'=>['sisfone::telefone.update', $telefone->id_telefone], 'method'=>'put']) !!}

        @include('sisfone::telefone._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection