<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

				
				{!! Form::model($proposicao, ['route'=>['parla::proposicoes.update.prioritario', $proposicao->id_proposicao], 'method'=>'put', 'id'=>'formulario']) !!}

				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Prioritário</h3>
				</div>

				<div class="modal-body">
					@include('parla::proposicoes.prioritario._form',['submit_text' => 'Salvar'])
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