@extends('gescon::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('gescon::contratantes.assinante.associate_assinante', $contratante) !!}

@endsection


@section('page-header')
  Adicionar Assinante
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $contratante->orgao->sg_orgao }}
  </small>
@endsection


@section('content')

  <div class="formulario-container">
      @include('gescon::contratantes.assinante._modal', ['id_contratante' => $contratante->id_contratante])
  </div> 

  {!! Form::model($contratante, ['route'=>['gescon::contratantes.update', 'id_contratante' => $contratante->id_contratante], 'method'=>'put', 'id' => 'formulario']) !!}

    @include('gescon::contratantes.assinante._form_associate_assinante',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
