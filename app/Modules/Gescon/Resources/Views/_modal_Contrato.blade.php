<div class="modal fade" id="modal-contrato" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if (isset($dadosContrato))
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						<i class="ace-icon fa fa-file-text-o smaller-120"></i>
						Dados do Contrato
					</h3>
				</div>	

				<div class="modal-body">
					
					<div class="row">
					    <div class="col-md-6">
					        <div class="form-group">
					            <strong>Número:</strong>
					            {{ $dadosContrato->nr_contrato }}
					        </div>
					    </div>

					    <div class="col-md-6">
					        <div class="form-group">
					        	<strong>UASG:</strong>
					            {{ $dadosContrato->co_uasg }}
					        </div>
					    </div>
					</div>

					<div class="row">
					    <div class="col-md-6">
					        <div class="form-group">
					        	<strong>Número Modalidade:</strong>
					            {{ $dadosContrato->nr_modalidade }}
					        </div>
					    </div>

					    <div class="col-md-6">
					        <div class="form-group">
					            <strong>Modalidade:</strong>
					            {{ isset($dadosContrato->modalidade) ? $dadosContrato->modalidade->no_modalidade : '' }}
					        </div>
					    </div>
					</div>
					
					<div class="row">
	                    <div class="col-md-12">
	                        <div class="form-group">
	                        	<strong>Descrição:</strong>
	                            {{ $dadosContrato->ds_objeto }}
	                        </div>
	                    </div>
	                </div>

				</div>
	        	
	        	<div class="modal-footer">
					
					<a href="{{ $dadosContrato->rota_visualizacao_contrato }}" class="btn btn-sm btn-primary insert">
					    <i class="fa fa-eye bigger-110"></i>
					    Visualizar Contrato
					</a>

				</div>

		     @endif

        	<div id='snippet'>
			   
			</div>

			<!-- In case that we want redraw section-->
			<div id='mySection'>
			    
			</div>
			
		</div>

	</div>

</div>