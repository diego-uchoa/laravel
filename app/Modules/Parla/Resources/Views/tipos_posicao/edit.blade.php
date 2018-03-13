@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::tiposPosicao.edit', $tipoPosicao) !!}

@endsection


@section('page-header')
  Editar - Tipo Posicao 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $tipoPosicao->id_tipoposicao }}
  </small>
@endsection


@section('content')

  {!! Form::model($tipoPosicao, ['route'=>['parla::tiposPosicao.update', $tipoPosicao->id_tipoposicao], 'method'=>'put']) !!}

    @include('parla::tiposPosicao._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
