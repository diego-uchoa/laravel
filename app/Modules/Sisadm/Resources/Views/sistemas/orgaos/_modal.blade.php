<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			{!! Form::open(['route'=>'sisadm::sistemas.orgaos.store','id'=>'formulario']) !!}
			{!! Form::hidden('id_sistema', $id_sistema) !!}

			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>Adicionar órgão</h3>
			</div>

			<div class="modal-body">
				@include('sisadm::sistemas.orgaos._form',['submit_text' => 'Salvar'])
			</div>

			<div class="modal-footer">
				{!! Form::button('Salvar', ['class'=>'btn btn-primary', 'id' => 'btnFormSalvarAJAX']) !!}
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