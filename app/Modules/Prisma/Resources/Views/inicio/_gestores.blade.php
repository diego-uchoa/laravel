<div class="row">
	<div class="col-md-4">
		<div class="row">
			<div class="widget-box">
			    <div class="widget-header widget-header-flat widget-header-small">
			        <h5 class="widget-title">
			            <i class="ace-icon fa fa-file-text"></i>
			            Geração de relatórios
			        </h5>
			    </div>

			    <div class="widget-body">
			        <div class="widget-main">
			        	<a href='http://10.206.52.24/extensions/prisma-relatorio/prisma-relatorio.html' class="btn btn-large btn-sm btn-primary" target="_blank">
			        	    </i>Relatório Mensal e Podium
			        	</a>
			        	<a href='http://10.206.52.24/extensions/prisma-frequencia/prisma-frequencia.html' class="btn btn-large btn-sm btn-primary" target="_blank">
			        	    </i>Distribuição de Frequência
			        	</a>
			        </div>
			    </div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="widget-box">
			    <div class="widget-header widget-header-flat widget-header-small">
			        <h5 class="widget-title">
			            <i class="ace-icon fa fa-exclamation-triangle"></i>
			            Solicitações de cadastro pendentes
			        </h5>
			    </div>

			    <div class="widget-body">
			        <div class="widget-main">
			        	@if(sizeof($solicitacoes) > 0)
				        	<table class="table table-striped table-bordered table-hover">
				        		<thead>
				        			<th>Razão social</th>
				        			<th>Situação</th>
				        		</thead>
				        	    <tbody>
				        	    	@foreach($solicitacoes as $solicitacao)
				        	    		<tr>
					        	    		<td><a href="{{route('prisma::solicitacao.cadastro.edit',['id'=>$solicitacao->id_solicitacao_cadastro])}}">{!! $solicitacao->no_razao_social !!}</a></td>
					        	    		<td>{!! $solicitacao->situacao() !!}</td>
				        	    		</tr>
				        	    	@endforeach
				        	    </tbody>
				        	</table>
				        @else
				        	<div class="alert alert-success">
				        	    <button type="button" class="close" data-dismiss="alert">
				        	        <i class="ace-icon fa fa-times"></i>
				        	    </button>
				        	    <strong>Nenhuma solicitação de cadastro com situação Aguardando análise ou Em análise.</strong>
				        	</div>
				        @endif
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>