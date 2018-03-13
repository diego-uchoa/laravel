@extends('parla::layouts.master')

@section('script-head')
    {!! Charts::assets() !!}

<script type="text/javascript">

</script>
@endsection

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::inicio') !!}

@endsection

@section('content')

<br>
<div class="row center">
	<div class="col-md-12">
		<a href="{{ route('parla::proposicoes.index') }}">
			<div class="infobox infobox-blue2 infobox-medium infobox-dark">
			    <div class="infobox-icon">
			        <i class="ace-icon fa fa-files-o"></i>
			    </div>
			    <div class="infobox-data">
			        <div class="infobox-content">Proposições</div>
			        <div class="infobox-data-number">{{ $proposicoesCount }}</div>
			    </div>
			</div>
		</a>
		<a href="{{ route('parla::parlamentares.index') }}">
			<div class="infobox infobox-orange infobox-medium infobox-dark">
			    <div class="infobox-icon">
			        <i class="ace-icon fa fa-users"></i>
			    </div>
			    <div class="infobox-data">
			        <div class="infobox-content">Parlamentares</div>
			        <div class="infobox-data-number">{{ $parlamentaresCount }}</div>
			    </div>
			</div>
		</a>

		<a href="{{ route('parla::consultasMf.index') }}">
			<div class="infobox infobox-green infobox-medium infobox-dark">
			    <div class="infobox-icon">
			        <i class="ace-icon fa fa-question-circle"></i>
			    </div>
			    <div class="infobox-data">
			        <div class="infobox-content">Consultas ao MF</div>
			        <div class="infobox-data-number">{{ $consultasMfCount }}</div>
			    </div>
			</div>
		</a>

		<a href="{{ route('parla::respostas_mf.index') }}">
			<div class="infobox infobox-red infobox-medium infobox-dark">
			    <div class="infobox-icon">
			        <i class="ace-icon fa fa-send"></i>
			    </div>
			    <div class="infobox-data">
			        <div class="infobox-content">Respostas do MF</div>
			        <div class="infobox-data-number">{{ $respostasMfCount }}</div>
			    </div>
			</div>
		</a>

		<a href="{{ route('parla::comissoes.index') }}">
			<div class="infobox infobox-purple infobox-medium infobox-dark">
			    <div class="infobox-icon">
			        <i class="ace-icon fa fa-gavel"></i>
			    </div>
			    <div class="infobox-data">
			        <div class="infobox-content">Comissões</div>
			        <div class="infobox-data-number">{{ $comissoesCount }}</div>
			    </div>
			</div>
		</a>
	</div>
</div>

<br>
<hr>
<br>

<div class="row">
	<div class="col-md-4">
		<div class="row">
			<div class="widget-box">
			    <div class="widget-header widget-header-flat widget-header-small">
			        <h5 class="widget-title">
			            <i class="ace-icon fa fa-exclamation-triangle"></i>
			            Proposições ativas sem consultas
			        </h5>
			    </div>

			    <div class="widget-body">
			        <div class="widget-main">
			        	@if(sizeof($proposicoesSemConsultas) > 0)
				        	<table class="table table-striped table-bordered table-hover">
				        		<thead>
				        			<th>Proposição</th>
				        			<th>Casa em tramitação</th>
				        		</thead>
				        	    <tbody>
				        	    	@foreach($proposicoesSemConsultas as $proposicao)
				        	    		<tr>
				        	    		<td><a href="{{route('parla::proposicoes.show',['id'=>$proposicao->id_proposicao])}}">{!! $proposicao->sn_possui_revisora ? $proposicao->origem.' - '.$proposicao->revisora : $proposicao->origem !!}</a></td>
				        	    		<td>{!! $proposicao->ultima_tramitacao->sg_casa_tramitacao !!}</td>
				        	    	</tr>
				        	    	@endforeach
				        	    </tbody>
				        	</table>
				        @else
				        	<div class="alert alert-success">
				        	    <button type="button" class="close" data-dismiss="alert">
				        	        <i class="ace-icon fa fa-times"></i>
				        	    </button>
				        	    <strong>Todas as proposições cadastradas possuem consultas.</strong>
				        	</div>
				        @endif
			        </div>
			    </div>
			</div>
		</div>
		<div class="row">
			<div class="widget-box">
			    <div class="widget-header widget-header-flat widget-header-small">
			        <h5 class="widget-title">
			            <i class="ace-icon fa fa-refresh"></i>
			            Proposições tramitadas na semana
			            <small>({{ $dtInicio }} - {{ $dtFim }})</small>
			        </h5>
			    </div>

			    <div class="widget-body">
			        <div class="widget-main">
			        	@if(sizeof($proposicoes) > 0)
			        		<div class="alert alert-info">
			        		    <button type="button" class="close" data-dismiss="alert">
			        		        <i class="ace-icon fa fa-times"></i>
			        		    </button>
			        		    <strong><i class="ace-icon fa fa-info-circle"></i> Atenção!</strong> Não serão exibidas tramitações cadastradas no Web Service após o término da semana em que ela ocorreu.
			        		    <br />
			        		</div>
				        	<table class="table table-striped table-bordered table-hover">
				        	    <tbody>
				        	    	@foreach($proposicoes as $tramitada)
				        	    		<tr><td><a href="{{route('parla::proposicoes.show',['id'=>$tramitada->id_proposicao])}}">{!! $tramitada->proposicao->sn_possui_revisora ? $tramitada->proposicao->origem.' - '.$tramitada->proposicao->revisora : $tramitada->proposicao->origem !!}</a></td></tr>
				        	    	@endforeach
				        	    </tbody>
				        	</table>
				        @else
				        	<div class="alert alert-danger">
				        	    <button type="button" class="close" data-dismiss="alert">
				        	        <i class="ace-icon fa fa-times"></i>
				        	    </button>
				        	    <strong>Nenhuma proposição tramitada no período.</strong><br><br>
				        	    <strong><i class="ace-icon fa fa-info-circle"></i></strong> Não serão exibidas tramitações cadastradas no Web Service após o término da semana em que ela ocorreu.
				        	    <br />
				        	</div>
				        @endif
			        </div>
			    </div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="widget-box">
		    <div class="widget-header widget-header-flat widget-header-small">
		        <h5 class="widget-title">
		            <i class="ace-icon fa fa-question-circle"></i>
		            Consultas ao MF
		        </h5>
		    </div>

		    <div class="widget-body">
		        <div class="widget-main">
		        	<div class="row">
		        		{!! $consultasGrafico->render() !!}
		        	</div>
		        	<div class="row">
		            	<div class="col-md-6">
	    		        	<table class="table table-striped table-bordered table-hover">
	    		        		<thead>
	    		        			<tr><th style="color:#fff; background-color:#d15b47; text-align:center;">Proposições com consultas atrasadas</th></tr>
	    		        		</thead>
	    		        	    <tbody>
	    		        	    	@if(sizeof($consultasAtrasadas) > 0)
		    		        	    	@foreach($consultasAtrasadas as $consulta)
		    		        	    		<tr><td><a href="{{route('parla::proposicoes.show',['id'=>$consulta->id_proposicao])}}">{!! $consulta->proposicao->sn_possui_revisora ? $consulta->proposicao->origem.' - '.$consulta->proposicao->revisora : $consulta->proposicao->origem !!}</a></td></tr>
		    		        	    	@endforeach
		    		        	    @else
		    		        	    	<tr><td><span class="text-success">Nenhuma consulta atrasada.</span></td></tr>
		    		        	    @endif
	    		        	    </tbody>
	    		        	</table>
		    		    </div>
		            	<div class="col-md-6">
	    		        	<table class="table table-striped table-bordered table-hover">
	    		        		<thead>
	    		        			<tr><th style="color:#fff; background-color:#3a87ad; text-align:center;">Proposições com consultas pendentes</th></tr>
	    		        		</thead>
	    		        	    <tbody>
	    		        	    	@if(sizeof($consultasPendentes) > 0)
		    		        	    	@foreach($consultasPendentes as $consulta)
		    		        	    		<tr><td><a href="{{route('parla::proposicoes.show',['id'=>$consulta->id_proposicao])}}">{!! $consulta->proposicao->sn_possui_revisora ? $consulta->proposicao->origem.' - '.$consulta->proposicao->revisora : $consulta->proposicao->origem !!}</a></td></tr>
		    		        	    	@endforeach
	    		        	    	@else
	    		        	    		<tr><td><span class="text-success">Nenhuma consulta pendente.</span></td></tr>
	    		        	    	@endif	
	    		        	    </tbody>
	    		        	</table>
		    		    </div>
		    		</div>
		        </div>
		    </div>
		</div>
	</div>
</div>

@endsection 

@section('script-end')
    <script src="{{ URL::asset('assets/js/jquery.matchHeight.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) { 
            $(document).ready(function() {
                $('.widget-header').matchHeight();
            });
        });
    </script>
@endsection