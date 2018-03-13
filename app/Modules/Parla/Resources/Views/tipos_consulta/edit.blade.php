@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::tiposConsulta.edit', $tipoConsulta) !!}

@endsection


@section('page-header')
  Editar - Tipo Consulta 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $tipoConsulta->id_tipoconsulta }}
  </small>
@endsection


@section('content')

  {!! Form::model($tipoConsulta, ['route'=>['parla::tiposConsulta.update', $tipoConsulta->id_tipoconsulta], 'method'=>'put']) !!}

    @include('parla::tiposConsulta._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
