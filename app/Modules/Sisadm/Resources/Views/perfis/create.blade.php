@extends('sisadm::layouts.master')


@section('breadcrumbs-page')
<li>
    <a href="#">Perfis</a>
</li>
<li class="active">Novo Perfil</li>
@endsection


@section('page-header')
	Criar Novo Perfil
@endsection

@section('content')

        {!! Form::open(['route'=>'sisadm::perfis.store']) !!}

        	@include('sisadm::perfis._form',['submit_text' => 'Salvar'])

        {!! Form::close() !!}

@endsection