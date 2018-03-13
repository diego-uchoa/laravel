@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
<li>
    <a href="#">Usuários</a>
</li>
<li class="active">Editar Usuários</li>
@endsection


@section('page-header')
	Editar Usuário 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$usuario->no_usuario}}
    </small>
@endsection


@section('content')

        {!! Form::model($usuario, ['route'=>['sisadm::usuarios.update', $usuario->id_usuario], 'method'=>'put']) !!}

        @include('sisadm::usuarios._form',['submit_text' => 'Editar'])

        {!! Form::close() !!}

@endsection