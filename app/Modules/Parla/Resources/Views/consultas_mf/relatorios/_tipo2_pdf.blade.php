@extends('parla::consultas_mf.relatorios.relatorio_pdf')

@section('content')
<div class="row">
	<div class="title">
		Relatório analítico de consulta por órgão
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

<ol>
	@foreach($dados as $orgao => $dado)
	    @if($orgao != "MF")
	    	<li>{{ $orgao }}</li>
	        @if( sizeof($dados[$orgao]["A"]) > 0)
	        	<div class="row">
		            <table style="width:100%" class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr><th colspan="4" style="color:#fff; background-color:#d15b47; text-align:center;">Consultas atrasadas</th></tr>
		                    <tr>
			                    <th>Proposição</th>
			                    <th>Ementa</th>
			                    <th>Envio</th>
			                    <th>Retorno</th>
			                </tr>
		                </thead>
		                <tbody>
		                    @foreach($dados[$orgao]["A"] as $consultaAtrasada)
		                        <tr>
		                            <td style="width:15%">{{ $consultaAtrasada->proposicao->sn_possui_revisora ? $consultaAtrasada->proposicao->origem.' - '.$consultaAtrasada->proposicao->revisora : $consultaAtrasada->proposicao->origem }}</td>
		                            <td style="width:65%">{{ $consultaAtrasada->proposicao->tx_ementa }}</td>
		                            <td style="width:10%">{{ $consultaAtrasada->dt_envio }}</td>
		                            <td style="width:10%">{{ $consultaAtrasada->dt_retorno }}</td>
		                        </tr>
		                    @endforeach
		                </tbody>
		            </table>
		        </div>
	        @endif
	        @if( sizeof($dados[$orgao]["P"]) > 0)
	        	<div class="row">
		            <table style="width:100%" class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr><th colspan="4" style="color:#fff; background-color:#3a87ad; text-align:center;">Consultas pendentes</th></tr>
		                    <tr>
			                    <th>Proposição</th>
			                    <th>Ementa</th>
			                    <th>Envio</th>
			                    <th>Retorno</th>
			                </tr>
		                </thead>
		                <tbody>
		                    @foreach($dados[$orgao]["P"] as $consultaPendente)
		                        <tr>
		                            <td style="width:15%">{{ $consultaPendente->proposicao->sn_possui_revisora ? $consultaPendente->proposicao->origem.' - '.$consultaPendente->proposicao->revisora : $consultaPendente->proposicao->origem }}</td>
		                            <td style="width:65%">{{ $consultaPendente->proposicao->tx_ementa }}</td>
		                            <td style="width:10%">{{ $consultaPendente->dt_envio }}</td>
		                            <td style="width:10%">{{ $consultaPendente->dt_retorno }}</td>
		                        </tr>
		                    @endforeach
		                </tbody>
		            </table>
		        </div>
	        @endif
	        @if( sizeof($dados[$orgao]["C"]) > 0)
	        	<div class="row">
		            <table style="width:100%" class="table table-striped table-bordered table-hover">
		                <thead>
		                    <tr><th colspan="4" style="color:#fff; background-color:#82af6f; text-align:center;">Consultas concluídas</th></tr>
		                    <tr>
			                    <th>Proposição</th>
			                    <th>Ementa</th>
			                    <th>Envio</th>
			                    <th>Retorno</th>
			                </tr>
		                </thead>
		                <tbody>
		                    @foreach($dados[$orgao]["C"] as $consultaConcluida)
		                        <tr>
		                            <td style="width:15%">{{ $consultaConcluida->proposicao->sn_possui_revisora ? $consultaConcluida->proposicao->origem.' - '.$consultaConcluida->proposicao->revisora : $consultaConcluida->proposicao->origem }}</td>
		                            <td style="width:65%">{{ $consultaConcluida->proposicao->tx_ementa }}</td>
		                            <td style="width:10%">{{ $consultaConcluida->dt_envio }}</td>
		                            <td style="width:10%">{{ $consultaConcluida->dt_retorno }}</td>
		                        </tr>
		                    @endforeach
		                </tbody>
		            </table>
		        </div>
	        @endif
	        @if($dado != end($dados))
	        	<div class="page-break"></div>
	        @endif
	    @endif
	@endforeach
</ol>



@endsection
