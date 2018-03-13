@extends('parla::consultas_mf.relatorios.relatorio_pdf')

@section('content')
<div class="row">
	<div class="title">
		Relatório por proposição legislativa
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
	@if( sizeof($dados) > 1)
		<div class="row">
			<p>Total de proposições consultadas: <strong>{{ count($dados) }}</strong></p>
		    <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width: 100%">
		        <thead>
		            <tr>
			            <th>Proposição</th>
			            <th>Ementa</th>
			            <th>Órgãos consultados</th>
			        </tr>
		        </thead>
		        <tbody>
		            @foreach($dados as $dado)
		                <tr>
		                    <td style="width:15%">{{ $dado['Proposição'] }}</td>
		                    <td style="width:70%">{{ $dado['Ementa'] }}</td>
		                    <td style="width:15%">{{ $dado['Órgãos'] }}</td>
		                </tr>
		            @endforeach
		        </tbody>
		    </table>
		</div>
	@endif
</div>

@endsection
