<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				@if(isset($id_proposicao))
					{!! Form::model($consultaMf, ['route'=>['parla::consultasMf.update', $consultaMf->id_consulta_mf, $id_proposicao], 'method'=>'put', 'id'=>'formulario']) !!}
				@else	
					{!! Form::model($consultaMf, ['route'=>['parla::consultasMf.update', $consultaMf->id_consulta_mf], 'method'=>'put', 'id'=>'formulario']) !!}
				@endif
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Consulta ao MF
					</h3>
				</div>	
			@else
				@if(isset($id_proposicao))
					{!! Form::open(['route'=>['parla::consultasMf.store',$id_proposicao], 'id'=>'formulario']) !!}
				@else	
					{!! Form::open(['route'=>'parla::consultasMf.store', 'id'=>'formulario']) !!}
				@endif
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Nova Consulta ao MF</h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('parla::consultas_mf._form',['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">
	        		@if(isset($id_proposicao))
	        			{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX_parla']) !!}
	        		@else	
	        			{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX']) !!}
	        		@endif
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