<div class="modal fade" id="modal-evento" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if (isset($dadosEvento))
				{!! Form::model($dadosEvento, ['id'=>'formulario']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							<i class="ace-icon fa fa-users smaller-120"></i>
							Dados do Evento
						</h3>
					</div>	

					<div class="modal-body">
						
						<div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            {!! Form::label('no_evento', 'Nome:') !!}
		                            {!! Form::text('no_evento', null, ['class'=>'form-control']) !!}
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            {!! Form::label('ds_evento', 'Descrição:') !!}
		                            {!! Form::text('ds_evento', null, ['class'=>'form-control']) !!}
		                        </div>
		                    </div>
		                </div>                

		                <div class="row">
		                    <div class="col-md-6">
		                        <div class="form-group">
		                            {!! Form::label('data_inicio', 'Data de Início:') !!}
		                            {!! Form::text('data_inicio', null, ['class'=>'form-control']) !!}
		                        </div>
		                    </div>

		                    <div class="col-md-6">
		                        <div class="form-group">
		                            {!! Form::label('data_fim', 'Data Fim:') !!}
		                            {!! Form::text('data_fim', null, ['class'=>'form-control']) !!}
		                        </div>
		                    </div>
		                </div>

					</div>
		        	
		        	<div class="modal-footer">
						
					</div>

		        {!! Form::close() !!}
		     @endif

        	<div id='snippet'>
			   
			</div>

			<!-- In case that we want redraw section-->
			<div id='mySection'>
			    
			</div>
			
		</div>

	</div>

</div>