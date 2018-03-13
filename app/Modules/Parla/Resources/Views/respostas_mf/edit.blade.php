@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::respostas_mf.edit', $respostaMf) !!}

@endsection


@section('page-header')
  Editar - Resposta Mf 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $respostaMf->id_resposta_mf }}
  </small>
@endsection


@section('content')

  {!! Form::model($respostaMf, ['route'=>['parla::respostas_mf.update', $respostaMf->id_resposta_mf], 'method'=>'put']) !!}

    @include('parla::respostas_mf._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
