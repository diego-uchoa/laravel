@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
<li>
    <a href="#">Perfis</a>
</li>
<li class="active">Editar Perfis</li>
@endsection


@section('page-header')
	Editar Perfil 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$perfil->no_perfil}}
    </small>
@endsection


@section('content')
      
        {!! Form::model($perfil, ['route'=>['sisadm::perfis.update', $perfil->id_perfil], 'method'=>'put']) !!}

        @include('sisadm::perfis._form',['submit_text' => 'Editar'])

        {!! Form::close() !!}


@endsection