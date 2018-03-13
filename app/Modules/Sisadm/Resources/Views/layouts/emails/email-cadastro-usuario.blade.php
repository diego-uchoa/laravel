@extends('layouts.template-email')

@section('cabecalho')
	<img src="{{ URL::asset('assets/img/logo_email.png') }}" height="35">
@endsection

@section('texto_introducao')
	Olá {{ $nome }},
@endsection

@section('texto_email')

	Seja bem-vindo ao Portal de Sistemas.<br><br>

	<b>Nome:</b> {{ $nome }}<br>	
	<b>CPF:</b> {{ $cpf }}<br>	
	<b>Email:</b> {{ $email }}<br>	
	<b>Lotação:</b> {{ $lotacao }}<br><br>	

	Estas são as informações para você acessar o Portal de Sistemas.<br><br>

	<b>Link:</b> {{ env('APP_URL') }} <br>	
	<b>Login:</b> {{ $cpf }}<br>
	
	@if ($senha == "")
		<b>Senha:</b> Favor utilizar a mesma senha da rede. <br><br><br>
	@else
		<b>Senha:</b> {{ $senha }} <br><br><br>		
	@endif

	Se tiver algum problema, comentários ou sugestões, por favor, entre em contato com a Central de Atendimento ao Portal, pelos telefones (61) 3412-3443, 3939, ou pelo e-mail: portal.df.spoa@fazenda.gov.br

@endsection

@section('texto_assinatura')
	Atenciosamente,<br>
	CEAP/COGTI/SPOA
@endsection