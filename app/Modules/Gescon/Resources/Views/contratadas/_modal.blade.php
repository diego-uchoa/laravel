<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($contratada, ['route'=>['gescon::contratadas.update', $contratada->id_contratada], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Contratada 
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{ $contratada->no_razao_social }}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'gescon::contratadas.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Nova Contratada </h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('gescon::contratadas._form',['submit_text' => 'Salvar'])
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