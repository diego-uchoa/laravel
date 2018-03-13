@extends('layouts.template-spoa')

@section('nome_sistema')
    Portal de Sistemas
@stop

@section('css')

{{ Html::style('css/navbar.css') }}

{{ Html::style('css/hover.css') }}

@endsection

@section('aviso_sistema')
	@include('layouts.parts._navbar-avisos-sistemas-geral')
@stop

@section('aviso_usuario')
	@include('layouts.parts._navbar-avisos-usuarios-geral')
@stop