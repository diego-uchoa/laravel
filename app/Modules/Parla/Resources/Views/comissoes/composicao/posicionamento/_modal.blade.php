<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

				
				{!! Form::model($membro, ['route'=>['parla::comissoes.update.posicionamento', $membro->pivot->id_comissao, $membro->id_parlamentar, $origin], 'method'=>'put', 'id'=>'formulario']) !!}

				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Posicionamento
						<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							{{ $membro->no_parlamentar }}
						</small>
					</h3>
				</div>

				<div class="modal-body">
					@include('parla::comissoes.composicao.posicionamento._form',['submit_text' => 'Salvar'])
				</div>

				<div class="modal-footer">
					{!! Form::button('Salvar', ['class'=>'btn btn-primary', 'id' => 'btnFormSalvarAJAX_parla']) !!}
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