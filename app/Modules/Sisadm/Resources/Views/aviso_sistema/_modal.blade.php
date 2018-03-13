<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($aviso, ['route'=>['sisadm::aviso_sistema.update', $aviso->id_aviso_sistema], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Aviso Sistema
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{$aviso->tx_aviso_sistema}}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'sisadm::aviso_sistema.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Novo Aviso Sistema</h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('sisadm::aviso_sistema._form',['submit_text' => 'Salvar'])
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