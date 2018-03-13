@extends('sisadm::layouts.master')


@section('breadcrumbs-page')
	
	{!! Breadcrumbs::render('sisadm::sistemas.edit', $sistema) !!}

@endsection


@section('page-header')
	Editar Sistema 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$sistema->no_sistema}}
    </small>
@endsection


@section('content')

	{!! Form::model($sistema, ['route'=>['sisadm::sistemas.update', $sistema->id_sistema], 'method'=>'put']) !!}

		@include('sisadm::sistemas._form',['submit_text' => 'Editar'])

	{!! Form::close() !!}
	
@endsection