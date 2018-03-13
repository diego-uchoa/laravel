<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($feriado, ['route'=>['sisadm::feriado.update', $feriado->id_feriado], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Feriado
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{$feriado->no_feriado}}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'sisadm::feriado.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Feriado</h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('sisadm::feriado._form',['submit_text' => 'Salvar'])
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