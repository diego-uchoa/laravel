@extends('layouts.master')

@section('content')

<div class="error-container">
	<div class="well">
		<h4 class="grey lighter smaller">
			<span class="blue bigger-125">
				<i class="ace-icon fa fa-remove icon-animated-wrench bigger-125"></i>
				403
			</span>
			Acesso Negado/Proibido.
		</h4>

		<hr>

		<div class="center">
			<a href="javascript:history.back()" class="btn btn-grey">
				<i class="ace-icon fa fa-arrow-left"></i>
				Voltar
			</a>

			<a href="{{route('portal.inicio')}}" class="btn btn-primary">
				Portal de Sistemas
			</a>
		</div>
	</div>
</div>
@endsection