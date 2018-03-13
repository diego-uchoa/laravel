<div class="modal fade" id="modal-feriado" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if (isset($dadosFeriado))
				{!! Form::model($dadosFeriado, ['id'=>'formulario']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							<i class="ace-icon fa fa-smile-o smaller-120"></i>
							Dados do Feriado
						</h3>
					</div>	

					<div class="modal-body">
						
						<div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            {!! Form::label('no_feriado', 'Nome:') !!}
		                            {!! Form::text('no_feriado', null, ['class'=>'form-control']) !!}
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
									{!! Form::label('dt_feriado', 'Data:') !!}
		                            {!! Form::text('dt_feriado', null, ['class'=>'form-control']) !!}
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