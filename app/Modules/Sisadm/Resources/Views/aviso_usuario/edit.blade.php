@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sisadm::aviso_usuario.edit', $aviso) !!}

@endsection


@section('page-header')
	Editar - Aviso Usuário 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$aviso->no_aviso_usuario}}
    </small>
@endsection


@section('content')

    {!! Form::model($aviso, ['route'=>['sisadm::aviso_usuario.update', $aviso->id_aviso_usuario], 'method'=>'put']) !!}

        @include('sisadm::aviso_usuario._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection