<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
			{!! Form::open(['route'=>'parla::proposicoes.store','id'=>'formulario']) !!}

			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>Adicionar proposição</h3>
			</div>

			<div class="modal-body">
				<div class="alert alert-info">
				    <button type="button" class="close" data-dismiss="alert">
					<i class="ace-icon fa fa-times"></i>
				    </button>
				    <strong><i class="fa fa-info-circle"></i></strong>
				    A busca deverá ser feita pela <strong>origem</strong> da proposição.
				    <br />
				</div>
				@include('parla::proposicoes._form',['submit_text' => 'Salvar'])
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