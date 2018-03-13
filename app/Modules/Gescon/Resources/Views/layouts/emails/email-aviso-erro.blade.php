@extends('layouts.template-email', ['corcabecalho' => '#25B394'])

@section('cabecalho')
	<img src="{{ URL::asset('icones/thumbnail_GESCON.png') }}" height="35" style="float:left;">
	
	<h1 style="font-size: 24px; margin-top: 5px">&nbsp; GESCON</h1>

@endsection

@section('texto_introducao')
	Olá,
@endsection

@section('texto_email')

	Estou enviando esse email porque houve uma falha no envio de notificações de contratos vencidos:<br><br>

	<b>Origem Erro:</b> {{ $origemErro }}<br>
	<b>Erro:</b> {{ $erro }}<br><br>	

@endsection

@section('texto_assinatura')
	Atenciosamente,<br>
	CEAP/COGTI/SPOA
@endsection