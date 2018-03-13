@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
	
	{!! Breadcrumbs::render('sisadm::feriado.edit', $feriado) !!}

@endsection


@section('page-header')
	Editar - Feriado 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$feriado->no_feriado}}
    </small>
@endsection


@section('content')

    {!! Form::model($feriado, ['route'=>['sisadm::feriado.update', $feriado->id_feriado], 'method'=>'put']) !!}

        @include('sisadm::feriado._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection