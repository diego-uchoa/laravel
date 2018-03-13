@extends('layouts.template-email', ['corcabecalho' => '#0E3455'])

@section('cabecalho')
	<img src="{{ URL::asset('icones/thumbnail_PRISMA.png') }}" height="35" style="float:left;">
	
	<h1 style="font-size: 24px; margin-top: 5px">&nbsp; PRISMA FISCAL</h1>

@endsection

@section('texto_introducao')
	Olá {{ $nome }},
@endsection

@section('texto_email')

	Seja bem-vindo ao Prisma Fiscal.<br><br>

	<b>Nome:</b> {{ $nome }}<br>	
	<b>CPF:</b> {{ $cpf }}<br>	
	<b>Email:</b> {{ $email }}<br>	
	<br>	

	Estas são as informações para você acessar o sistema:<br><br>

	<b>Link:</b> {{ route('prisma::login') }} <br>	
	<b>Login:</b> {{ $cpf }}<br>
	
	@if ($senha == "")
		<b>Senha:</b> Favor utilizar a mesma senha da rede. <br><br><br>
	@else
		<b>Senha:</b> {{ $senha }} <br><br><br>		
	@endif

	Se tiver algum problema, comentários ou sugestões, por favor, entre em contato com a Central de Atendimento, pelos telefones (61) 3412-3443, 3939, ou pelo e-mail: prisma@fazenda.gov.br

@endsection
