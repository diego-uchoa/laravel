<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($tipoSituacao, ['route'=>['parla::tipos_situacao.update', $tipoSituacao->id_tipo_situacao], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Tipo de Situação
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{ $tipoSituacao->tx_tipo_situacao }}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'parla::tipos_situacao.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Tipo de Situação</h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('parla::tipos_situacao._form',['submit_text' => 'Salvar'])
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