<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($tipoItemContratacao, ['route'=>['gescon::tipos_itens_contratacao.update', $tipoItemContratacao->id_tipo_item_contratacao], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Objeto de Contratação
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{ $tipoItemContratacao->ds_tipo_item_contratacao }}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'gescon::tipos_itens_contratacao.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Objeto de Contratação </h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('gescon::tipos_itens_contratacao._form',['submit_text' => 'Salvar'])
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