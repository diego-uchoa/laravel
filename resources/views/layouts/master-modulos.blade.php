@extends('layouts.template-spoa')

@section('nome_sistema')
    [NOME DO SISTEMA]
@stop

@section('breadcrumbs')
	@include('layouts.parts._breadcrumbs-spoa')
@stop

@section('menu_sistema')
	@include('layouts.parts._menu-spoa')
@stop

@section('acesso_portal')
	@include('layouts.parts._navbar-acesso-portal')
@stop

@section('ajuda_sistema')
	@include('layouts.parts._navbar-ajuda')
@stop

@section('lista_sistemas')
	@include('layouts.parts._navbar-sistemas-spoa')
@stop

@section('aviso_sistema')
	@include('layouts.parts._navbar-avisos-sistemas')
@stop

@section('aviso_usuario')
	@include('layouts.parts._navbar-avisos-usuarios')
@stop



