@extends('gescon::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('gescon::contratantes.usuario.associate_usuario', $contratante) !!}

@endsection


@section('page-header')
  Adicionar Usuário
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $contratante->orgao->sg_orgao }}
  </small>
@endsection


@section('content')

  <div class="formulario-container">
      @include('gescon::contratantes.usuario._modal', ['id_contratante' => $contratante->id_contratante])
  </div> 

  {!! Form::model($contratante, ['route'=>['gescon::contratantes.update', 'id_contratante' => $contratante->id_contratante], 'method'=>'put', 'id' => 'formulario']) !!}

    @include('gescon::contratantes.usuario._form_associate_usuario',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
