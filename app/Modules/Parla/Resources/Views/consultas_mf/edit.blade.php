@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::consultasMf.edit', $consultaMf) !!}

@endsection


@section('page-header')
  Editar Consulta Mf 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $consultaMf->id_consulta_mf }}
  </small>
@endsection


@section('content')

  {!! Form::model($consultaMf, ['route'=>['parla::consultasMf.update', $consultaMf->id_consulta_mf], 'method'=>'put']) !!}

    @include('parla::consultas_mf._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
