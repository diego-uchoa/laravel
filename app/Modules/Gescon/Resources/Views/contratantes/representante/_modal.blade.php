<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if(isset($mode))	
				{!! Form::model($representante, ['route'=>['gescon::contratante_representante.update', 'id' => $representante->id_contratante_representante, 'id_contratante' => $id_contratante], 'method'=>'put', 'id'=>'formulario']) !!}
					{!! Form::hidden('id_contratante', $id_contratante, ['class' => 'form-control', 'id' => 'id_contratante']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							Editar Representante
							<small>
						        <i class="ace-icon fa fa-angle-double-right"></i>
						        {{ $representante->no_representante }}
						    </small>
						</h3>
					</div>	
			@else
				{!! Form::open(['route'=>['gescon::contratante_representante.store', $id_contratante], 'id'=>'formulario']) !!}
					{!! Form::hidden('id_contratante', $id_contratante, ['class' => 'form-control', 'id' => 'id_contratante']) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>Criar Novo Representante </h3>
					</div>	
			@endif

				<div class="modal-body">
					@include('gescon::contratantes.representante._form',['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">
					{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary store_representante', 'id' => 'btnFormSalvarAJAX']) !!}
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