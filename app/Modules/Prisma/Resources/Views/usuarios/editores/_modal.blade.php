<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			@if(isset($mode))

				@if($mode == "update")
					{!! Form::model($usuario, ['route'=>['prisma::usuarios.update.editor', $usuario->id_usuario], 'method'=>'put', 'id'=>'formulario']) !!}
					{!! Form::hidden('id_usuario', $usuario->id_usuario) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							Editar dados do editor
							<small>
						        <i class="ace-icon fa fa-angle-double-right"></i>
						        {{$usuario->no_usuario}}
						    </small>	
						</h3>
					</div>	
				@else
					{!! Form::open(['route'=>'prisma::usuarios.store.editor', 'id'=>'formulario']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>Adicionar editor</h3>
					</div>	
				@endif

					<div class="modal-body">
						@include('prisma::usuarios.editores._form',['submit_text' => 'Salvar'])
					</div>
		        	
		        	<div class="modal-footer">
						{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX_prisma']) !!}
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