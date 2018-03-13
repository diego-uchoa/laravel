@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::contratos.index') !!}

@endsection

@section('page-header')
    Visualização do Contrato {{ $contrato->nr_contrato }}
@endsection

@section('content')

    {!! Form::model($contrato, ['route'=>['gescon::contratos.terceirizacao.update', $contrato->id_contrato], 'method'=>'put', 'id'=>'formulario']) !!}

      @include('gescon::contratos._show_contratante')    	
      
      <br>

      @include('gescon::contratos._show_contratada')

      <br>

      @include('gescon::contratos.terceirizacao._show_contratacao')      

    	<br>

      @include('gescon::contratos._show_data_pagamento_variacao')      
      
      <br>

      @include('gescon::contratos._show_fiscal')      

      <br>

      @include('gescon::contratos._show_informacoes_adicionais')            

      <hr />
      <div class="row center">
        <div class="col-xs-12 col-sm-12">
          <a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>
        </div>
      </div>

    {!! Form::close() !!}

@endsection