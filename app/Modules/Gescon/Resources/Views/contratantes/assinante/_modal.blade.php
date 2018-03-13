<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")	
				{!! Form::model($assinante, ['route'=>['gescon::contratante_assinante.update', 'id' => $assinante->id_contratante_assinante, 'id_contratante' => $id_contratante], 'method'=>'put', 'id'=>'formulario']) !!}
					{!! Form::hidden('id_contratante', $id_contratante, ['class' => 'form-control', 'id' => 'id_contratante']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							Editar Assinante
							<small>
						        <i class="ace-icon fa fa-angle-double-right"></i>
						        {{ $assinante->no_assinante }}
						    </small>
						</h3>
					</div>	
			@else
				{!! Form::open(['route'=>['gescon::contratante_assinante.store', $id_contratante], 'id'=>'formulario']) !!}
					{!! Form::hidden('id_contratante', $id_contratante, ['class' => 'form-control', 'id' => 'id_contratante']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>Criar Novo Assinante </h3>
					</div>	
			@endif

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