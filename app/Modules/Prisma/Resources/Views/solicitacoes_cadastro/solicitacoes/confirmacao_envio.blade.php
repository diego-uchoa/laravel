@extends('prisma::layouts.public')

@section('content')

	@section('page-header')
	    Solicitar cadastro de instituição
	@endsection
	
	<div class="alert alert-block alert-success">

		<p>
			<strong>
				<i class="ace-icon fa fa-check"></i>
				Solitação enviada para os gestores do sistema
			</strong>
			<p>
				Sua solicitação de cadastro foi realizada com sucesso. Após a análise da solicitação pelos gestores do Prisma, será enviado um e-mail para o responsável informando se ela foi aprovada ou rejeitada. Caso tenha sido aprovada, o responsável e editores receberão os dados de acesso ao sistema.
			</p>
		</p>


	</div>


@endsection 

@section('script-end')

@endsection