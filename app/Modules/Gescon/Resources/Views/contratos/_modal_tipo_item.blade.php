<div class="modal fade" id="modal-create-tipo-item" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>Selecionar Tipo de Item</h3>
			</div>

			<div class="modal-body">
				<div class="form-group">
					{!! Form::label('id_tipo', 'Tipo de Item:') !!}
					{!! Form::select('id_tipo', $listaTipoItemContratacao, null, ['class'=>'form-control chosen-select select-tipo-item', 'id' => 'id_tipo']) !!}
				</div>
			</div>

		</div>

	</div>

</div>