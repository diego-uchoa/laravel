@extends('gescon::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('gescon::contratantes.representante.associate_representante', $contratante) !!}

@endsection


@section('page-header')
  Associar Representante
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $contratante->orgao->sg_orgao }}
  </small>
@endsection


@section('content')

  <div class="formulario-container">
      @include('gescon::contratantes.representante._modal', ['id_contratante' => $contratante->id_contratante])
  </div> 

  {!! Form::model($contratante, ['route'=>['gescon::contratantes.update', 'id_contratante' => $contratante->id_contratante], 'method'=>'put', 'id' => 'formulario']) !!}

    @include('gescon::contratantes.representante._form_associate_representante',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
