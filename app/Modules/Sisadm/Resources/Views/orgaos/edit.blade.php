@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('sisadm::orgaos.edit', $orgao) !!}

@endsection


@section('page-header')
  Editar - Orgao 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $orgao->id_orgao }}
  </small>
@endsection


@section('content')

  {!! Form::model($orgao, ['route'=>['sisadm::orgaos.update', $orgao->id_orgao], 'method'=>'put']) !!}

    @include('sisadm::orgaos._form',['submit_text' => 'Editar'])

  {!! Form::close() !!}
  
@endsection
