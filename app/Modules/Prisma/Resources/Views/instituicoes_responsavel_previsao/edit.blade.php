@extends('prisma::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('prisma::instituicoes_responsavel_previsao.edit', $instituicaoResponsavelPrevisao) !!}

@endsection


@section('page-header')
  Editar - Instituição responsável pela previsão 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao }}
  </small>
@endsection


@section('content')

  {!! Form::model($instituicaoResponsavelPrevisao, ['route'=>['prisma::instituicoes_responsavel_previsao.update', $instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao], 'method'=>'put']) !!}

    @include('prisma::instituicoes_responsavel_previsao._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
