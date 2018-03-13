@extends('sisadm::layouts.master')


@section('breadcrumbs-page')
<li>
    <a href="#">Usuários</a>
</li>
<li class="active">Novo Usuário</li>
@endsection


@section('page-header')
	Criar Novo Usuário
@endsection

@section('content')

        {!! Form::open(['route'=>'sisadm::usuarios.store']) !!}

        @include('sisadm::usuarios._form',['submit_text' => 'Salvar'])

        {!! Form::close() !!}

@endsection