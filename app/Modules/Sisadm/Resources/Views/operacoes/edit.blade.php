@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
	<li>
	    <a href="#">Operações</a>
	</li>
	<li class="active">Editar</li>
@endsection


@section('page-header')
	Editar Operação 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$operacao->no_operacao}}
    </small>
@endsection


@section('content')

    {!! Form::model($operacao, ['route'=>['sisadm::operacoes.update', $operacao->id_operacao], 'method'=>'put']) !!}

        @include('sisadm::operacoes._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection