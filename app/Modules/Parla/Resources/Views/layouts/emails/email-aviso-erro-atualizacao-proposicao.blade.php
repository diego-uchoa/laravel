@extends('layouts.template-email')

@section('cabecalho')
	<img src="{{ URL::asset('assets/img/logo_email.png') }}" height="35">
@endsection

@section('texto_introducao')
	Olá,
@endsection

@section('texto_email')

	Estou enviando esse email porque houve uma falha na atualização da proposição:<br><br>

	<b>Tipo:</b> {{ $tipo }}<br>	
	<b>Número:</b> {{ $numero }}<br>	
	<b>Ano:</b> {{ $ano }}<br>	
	<b>Casa:</b> {{ $casa }}<br>
	<b>Origem Erro:</b> {{ $origemErro }}<br>
	<b>Erro:</b> {{ $erro }}<br><br>	

@endsection

@section('texto_assinatura')
	Atenciosamente,<br>
	CEAP/COGTI/SPOA
@endsection