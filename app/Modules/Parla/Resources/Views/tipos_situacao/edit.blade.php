@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::tipos_situacao.edit', $tipoSituacao) !!}

@endsection


@section('page-header')
  Editar - Tipo Situacao 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $tipoSituacao->id_tipo_situacao }}
  </small>
@endsection


@section('content')

  {!! Form::model($tipoSituacao, ['route'=>['parla::tipos_situacao.update', $tipoSituacao->id_tipo_situacao], 'method'=>'put']) !!}

    @include('parla::tipos_situacao._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
