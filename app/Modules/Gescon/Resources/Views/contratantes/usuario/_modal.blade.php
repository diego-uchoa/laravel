<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			{!! Form::open(['route'=>['gescon::contratante_usuario.store'], 'id'=>'formulario']) !!}
				{!! Form::hidden('id_contratante', $id_contratante, ['class' => 'form-control', 'id' => 'id_contratante']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Usuário </h3>
				</div>	
				<div class="modal-body">
					@include('gescon::contratantes.usuario._form', ['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">
					{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary store_usuario', 'id' => 'btnFormSalvarAJAX']) !!}
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