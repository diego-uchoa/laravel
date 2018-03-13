@extends('gescon::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('gescon::tipos_itens_contratacao.edit', $tipoItemContratacao) !!}

@endsection


@section('page-header')
  Editar - Objeto de Contratação 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $tipoItemContratacao->ds_tipo_item_contratacao }}
  </small>
@endsection


@section('content')

  {!! Form::model($tipoItemContratacao, ['route'=>['gescon::tipos_itens_contratacao.update', $tipoItemContratacao->id_tipo_item_contratacao], 'method'=>'put']) !!}

    @include('gescon::tipos_itens_contratacao._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
