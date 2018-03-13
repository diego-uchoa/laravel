@extends('gescon::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('gescon::fiscais.edit', $fiscal) !!}

@endsection


@section('page-header')
  Editar - Fiscal 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $fiscal->id_fiscal }}
  </small>
@endsection


@section('content')

  {!! Form::model($fiscal, ['route'=>['gescon::fiscais.update', $fiscal->id_fiscal], 'method'=>'put']) !!}

    @include('gescon::fiscais._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
