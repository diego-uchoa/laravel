<div class="modal fade" id="modal-create-edificio" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>Selecionar Edifício</h3>
			</div>

			<div class="modal-body">
				<div class="form-group">
					{!! Form::label('sg_uf', 'UF:') !!}
					<i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_edificio" style="display:none"></i>
					{!! Form::select('sg_uf', $listUfEdificio, null, ['class'=>'form-control select-uf', 'id' => 'sg_uf']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('id_edificio', 'Edifício:') !!}
					{!! Form::select('id_edificio', ['' => ''], null, ['class'=>'form-control select-edificio', 'id' => 'id_edificio']) !!}
				</div>
			</div>

		</div>

	</div>

</div>