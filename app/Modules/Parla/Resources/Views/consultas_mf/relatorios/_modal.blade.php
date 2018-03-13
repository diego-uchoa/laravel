<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">	
			{!! Form::open(['route'=>'parla::consultasMf.relatorio.generate', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Gerar relatório em PDF</h3>
				</div>	

				<div class="modal-body">
					@include('parla::consultas_mf.relatorios._form',['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">	
	        		{!! Form::button('<i class="ace-icon fa fa-download bigger-110"></i> Download', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX', 'disabled' => 'disabled']) !!}
				</div>
	        {!! Form::close() !!}

        	<div id='snippet'>
			   
			</div>

			<!-- In case that we want redraw section-->
			<div id='mySection'>
			    
			</div>
			
		</div>

	</div>

</div>