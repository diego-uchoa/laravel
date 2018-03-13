<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			@if(isset($mode))

				@if($mode == "update")
					{!! Form::model($usuario, ['route'=>['prisma::usuarios.update.responsavel', $usuario->id_usuario], 'method'=>'put', 'id'=>'formulario']) !!}
					{!! Form::hidden('id_usuario', $usuario->id_usuario) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							Editar dados do responsável
							<small>
						        <i class="ace-icon fa fa-angle-double-right"></i>
						        {{$usuario->no_usuario}}
						    </small>	
						</h3>
					</div>
				@elseif($mode == "change")
					{!! Form::open(['route'=>'prisma::usuarios.alter.responsavel', 'id'=>'formulario']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>Substituir responsável</h3>
					</div>
				@else
					{!! Form::open(['route'=>'prisma::usuarios.store.responsavel', 'id'=>'formulario']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>Adicionar responsável</h3>
					</div>	
				@endif

					<div class="modal-body">
						@if(Auth::user()->hasPerfil('PRISMA-ResponsavelInstituicao') && $mode == "change")
							<div class="alert alert-danger">
							    <button type="button" class="close" data-dismiss="alert">
							        <i class="ace-icon fa fa-times"></i>
							    </button>
							    <p>
							        <strong>
							            <i class="ace-icon fa fa-warning"></i>
							            Atenção!
							        </strong>
							        <br>
							        Ao substituir o responsável, sua sessão no sistema será encerrada e você não terá mais acesso ao sistema Prisma.
							    </p>
							</div>
						@endif
						@include('prisma::usuarios.responsavel._form',['submit_text' => 'Salvar'])
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