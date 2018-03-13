<div class="modal fade" id="modal-aniversario" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if (isset($dadosAniversario))
				{!! Form::model($dadosAniversario, ['id'=>'formulario']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							<i class="ace-icon fa fa-birthday-cake smaller-120"></i>
							Dados do Aniversariante
						</h3>
					</div>	

					<div class="modal-body">
						
						<div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            {!! Form::label('no_usuario', 'Nome:') !!}
		                            {!! Form::text('no_usuario', null, ['class'=>'form-control']) !!}
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            {!! Form::label('no_orgao', 'Órgão:') !!}
		                            {!! Form::text('orgao[no_orgao]', null, ['class'=>'form-control']) !!}
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