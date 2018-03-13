<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($parlamentar, ['route'=>['parla::parlamentares.update', $parlamentar->id_parlamentar], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Parlamentar 
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{ $parlamentar->id_parlamentar }}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'parla::parlamentares.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Parlamentar </h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('parla::parlamentares._form',['submit_text' => 'Salvar'])
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