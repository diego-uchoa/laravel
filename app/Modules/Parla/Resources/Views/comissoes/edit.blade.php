@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::comissoes.edit', $comissao) !!}

@endsection


@section('page-header')
  Editar Comissao 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $comissao->id_comissao }}
  </small>
@endsection


@section('content')

  {!! Form::model($comissao, ['route'=>['parla::comissoes.update', $comissao->id_comissao], 'method'=>'put']) !!}

    @include('parla::comissoes._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
