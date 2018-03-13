@extends('parla::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('parla::proposicoes.edit', $proposicao) !!}

@endsection


@section('page-header')
  Editar Proposicao 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $proposicao->id_proposicao }}
  </small>
@endsection


@section('content')

  {!! Form::model($proposicao, ['route'=>['parla::proposicoes.update', $proposicao->id_proposicao], 'method'=>'put']) !!}

    @include('parla::proposicoes._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
