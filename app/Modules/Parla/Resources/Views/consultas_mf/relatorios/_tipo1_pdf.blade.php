@extends('parla::consultas_mf.relatorios.relatorio_pdf')

@section('content')
<div class="row">
	<div class="title">
		Relatório quantitativo de consultas a órgãos
	</div>
	<div class="periodo">
		<strong>Período de análise:</strong>
		@if($dtInicio and $dtFim)
		{{ $dtInicio }} - {{ $dtFim }}
		@elseif($dtInicio and !($dtFim))
		A partir de {{ $dtInicio }}
		@elseif(!($dtInicio) and $dtFim)
		Até {{ $dtFim }}
		@else
		Todas as datas
		@endif
		<br>
		<strong>Casa de tramitação:</strong>
		@if($sgCasaTramitacao == 'CD')
		    Câmara dos Deputados
		@elseif($sgCasaTramitacao == 'SF')
		    Senado Federal
		@elseif(!$sgCasaTramitacao)
		    Todas as casas
		@endif
	</div>
</div>

<div class="row">
	<table>
		<thead>
			<tr><th colspan="4" style="background-color:#aaa; text-align:center;">Quantidade de consultas realizadas - Geral</th></tr>
			<tr>
				<th>Concluídas</th>
				<th>Pendentes</th>
				<th>Atrasadas</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $dados["MF"]["C"] }}</td>
				<td>{{ $dados["MF"]["P"] }}</td>
				<td>{{ $dados["MF"]["A"] }}</td>
				<td>{{ $dados["MF"]["C"] + $dados["MF"]["P"] + $dados["MF"]["A"] }}</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="row">
	<table>
	    <thead>
	        <tr><th colspan="5" style="background-color:#aaa; text-align:center;">Consultas por órgão</th></tr>
	        <tr>
		        <th>Órgão</th>
		        <th>Concluídas</th>
		        <th>Pendentes</th>
		        <th>Atrasadas</th>
		        <th>Total</th>
		    </tr>
	    </thead>
	    <tbody>
	        @foreach($dados as $orgao => $dado)
	            @if($orgao != "MF")
	                <tr>
	                    <td>{{ $orgao }}</td>
	                    <td>{{ $dados[$orgao]["C"] }}</td>
	                    <td>{{ $dados[$orgao]["P"] }}</td>
	                    <td>{{ $dados[$orgao]["A"] }}</td>
	                    <td>{{ $dados[$orgao]["C"] + $dados[$orgao]["P"] + $dados[$orgao]["A"] }}</td>
	                </tr>
	            @endif
	        @endforeach
	    </tbody>
	</table>
</div>

@endsection
