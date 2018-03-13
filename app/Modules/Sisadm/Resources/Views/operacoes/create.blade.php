@extends('sisadm::layouts.master')


@section('breadcrumbs-page')
	<li>
	    <a href="#">Operações</a>
	</li>
	<li class="active">Nova Operação</li>
@endsection


@section('page-header')
	Criar Nova Operação
@endsection

@section('content')

    {!! Form::open(['route'=>'sisadm::operacoes.store']) !!}

        @include('sisadm::operacoes._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection