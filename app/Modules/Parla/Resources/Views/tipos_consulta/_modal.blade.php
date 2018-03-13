<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($tipoConsulta, ['route'=>['parla::tiposConsulta.update', $tipoConsulta->id_tipo_consulta], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Tipo de Consulta 
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{ $tipoConsulta->tx_tipo_consulta }}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'parla::tiposConsulta.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Tipo Consulta </h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('parla::tipos_consulta._form',['submit_text' => 'Salvar'])
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