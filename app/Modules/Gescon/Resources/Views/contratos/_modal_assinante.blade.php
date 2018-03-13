<div class="modal fade" id="modal-create-assinante" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			{!! Form::open(['route'=>['gescon::contratante_assinante.store_assinante_contrato'], 'id'=>'formulario_assinante']) !!}
				{!! Form::hidden('id_contratante_contrato', null, ['class' => 'form-control', 'id' => 'id_contratante_contrato']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Assinante </h3>
				</div>	
		
				<div class="modal-body">
					@include('gescon::contratantes.assinante._form',['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">
					{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary store_assinante', 'id' => 'btnFormSalvarAJAX']) !!}
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