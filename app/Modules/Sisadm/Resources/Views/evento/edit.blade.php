@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
	
	{!! Breadcrumbs::render('sisadm::evento.edit', $evento) !!}

@endsection


@section('page-header')
	Editar - Evento 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$evento->no_evento}}
    </small>
@endsection


@section('content')

    {!! Form::model($evento, ['route'=>['sisadm::evento.update', $evento->id_evento], 'method'=>'put']) !!}

        @include('sisadm::evento._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection