@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::tiposProposicao.edit', $tipoProposicao) !!}

@endsection


@section('page-header')
  Editar - Tipo Proposicao 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $tipoProposicao->id_tipoproposicao }}
  </small>
@endsection


@section('content')

  {!! Form::model($tipoProposicao, ['route'=>['parla::tiposProposicao.update', $tipoProposicao->id_tipoproposicao], 'method'=>'put']) !!}

    @include('parla::tiposProposicao._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
