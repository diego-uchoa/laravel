<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($usuario, ['route'=>['sisadm::usuarios.update', $usuario->id_usuario], 'method'=>'put', 'id'=>'formulario']) !!}
				{!! Form::hidden('id_usuario', $usuario->id_usuario) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Usuário
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{$usuario->no_usuario}}
					    </small>	
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'sisadm::usuarios.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Usuário</h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('sisadm::usuarios._form',['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">
					{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX']) !!}
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