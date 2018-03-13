@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisadm::aviso_sistema.edit', $aviso) !!}

@endsection


@section('page-header')
	Editar - Aviso Sistema 	
@endsection


@section('content')

    {!! Form::model($aviso, ['route'=>['sisadm::aviso_sistema.update', $aviso->id_aviso_sistema], 'method'=>'put']) !!}

        @include('sisadm::aviso_sistema._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection