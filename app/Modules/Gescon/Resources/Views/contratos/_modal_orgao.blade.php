<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>Selecionar a Unidade Atendida</h3>
			</div>

			<div class="modal-body">
				<div class="form-group">
					{!! Form::label('orgao', 'Órgão:') !!}
					{!! Form::select('id_orgao', $listaOrgaos, null, ['class'=>'form-control chosen-select select-orgao', 'id' => 'id_orgao']) !!}
				</div>
			</div>

		</div>

	</div>

</div>