@extends('prisma::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('prisma::instituicoes.edit', $instituicao) !!}

@endsection


@section('page-header')
  Editar Instituição 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $instituicao->no_razao_social }}
  </small>
@endsection


@section('content')

  {!! Form::model($instituicao, ['route'=>['prisma::instituicoes.update', $instituicao->id_instituicao], 'method'=>'put']) !!}

    @include('prisma::instituicoes._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
