@extends('layouts.template-email')

@section('cabecalho')
	<img src="{{ URL::asset('assets/img/logo_email.png') }}" height="35">
@endsection

@section('texto_introducao')
	Olá {{ $nome }},
@endsection

@section('texto_email')

	O atestado abaixo foi cadastrado no SISMED:<br><br>

	<b>Prazo:</b> {{ $prazo }}<br>	
	<b>Data Início:</b> {{ $dataInicio }}<br>	
	<b>Data Fim:</b> {{ $dataFim }}<br><br>		

	Para maiores informações, por favor, entre em contato com o Serviço Médico, pelos telefones (61) 3412-2100/2102, ou pelo e-mail: saudedoservidor.df.samf@fazenda.gov.br.

@endsection

@section('texto_assinatura')
	Atenciosamente,<br>
	SEAS/GESPE/SAMF
@endsection