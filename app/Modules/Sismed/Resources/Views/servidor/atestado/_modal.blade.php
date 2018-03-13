<div class="col-lg-12">

<div class="modal fade" id="modal-delete" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">
			
			{!! Form::open(['route'=>['sismed::atestado.destroy'],'method'=>'post', 'id'=>'formExcluirAJAX', 'name'=>'formExcluirAJAX']) !!}
			<meta name="_token" content="{!! csrf_token() !!}"/>
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Excluir Atestado</h3>
				</div>
				<div class="modal-body">
					@include('errors.errors')
					<input type="hidden" name="id_atestado" id='id_atestado' value="">
					<input type="hidden" name="destroy" value="1">
					<div class="form-group">
		                {!! Form::label('tx_justificativa_exclusao', 'Justificativa para exclusão:') !!}
		                {!! Form::textarea('tx_justificativa_exclusao', null, ['class'=>'form-control', 'id'=>'tx_justificativa_exclusao']) !!}
		            </div>
				</div>
	        	
	        	<div class="modal-footer">
	        		<a href="#" class="btn btn-large btn-sm btn-danger" id="btnFormExlcuirCancelar" data-dismiss="modal">Cancelar</a>
					{!! Form::button('Excluir', ['class'=>'btn btn-sm btn-primary delete-atestado', 'id' => 'btnFormExlcuirAJAX']) !!}
				</div>

			{!! Form::close() !!}

		</div>

	</div>

</div>

<div class="modal fade" id="modal-create" role="dialog">
	

	
	<div class="modal-dialog">
		
		<div class="modal-content">

			@if($mode == "update")
			

				{!! Form::model($atestado, ['route'=>['sismed::atestado.update', $atestado->id_atestado], 'method'=>'put','id'=>'formulario', 'name'=>'formulario', 'enctype' => 'multipart/form-data', 'mode' => $mode]) !!}
				<input type="hidden" name="id_servidor" value="{!! $atestado->id_servidor !!}">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Editar Atestado</h3>
				</div>
				
				<!-- Arquivo Atestado -->
				@if($atestado->no_atestado_fisico)
					@section('anexo')
						<input type="hidden" name="atestado_delete" value="false">
						<input type="hidden" name="atestado_atual" value="{!! $atestado->no_atestado_fisico !!}">
						<div id="row-anexo">
							<a href="/uploads/sismed/{{ $servidor->co_prontuario }}/{{ $atestado->no_atestado_fisico }}" class="btn btn-minier btn-yellow" target="_blank">
							    <i class="ace-icon fa fa-pencil-square-o"></i>Atestado
							    
							</a>
							<a href="#" class="btn btn-minier btn-danger" id="btn-exclur-atestado">
							    <i class="ace-icon fa fa-trash-o"></i>Excluir
							</a>
						</div>
						<div id="row-anexo-input" style="display: none">
							{!! Form::file('atestado', ['class'=>'form-control input-large', 'id'=>'arquivo-atestado']) !!}   
						</div>
	
					@endsection
				@else
					@section('anexo')
						<div id="row-anexo-input">
							{!! Form::file('atestado',['class'=>'form-control input-large', 'id'=>'arquivo-atestado']) !!}    
						</div>
					@endsection
				@endif

				<!-- Arquivo Laudo -->
				@if($atestado->no_laudo_fisico)
					@section('laudo')
						<input type="hidden" name="laudo_delete" value="false"> 
						<input type="hidden" name="laudo_atual" value="{!! $atestado->no_laudo_fisico !!}">
						<div id="row-laudo">
							
							<a href="/uploads/sismed/{{ $servidor->co_prontuario }}/{{ $atestado->no_laudo_fisico }}" class="btn btn-minier btn-yellow" target="_blank">
							    <i class="ace-icon fa fa-stethoscope"></i>Laudo
							</a>
							<a href="#" class="btn btn-minier btn-danger" id="btn-exclur-laudo">
							    <i class="ace-icon fa fa-trash-o"></i>Excluir
							</a>
						</div>
						<div id="row-laudo-input" style="display: none">
							{!! Form::file('laudo', ['class'=>'form-control input-large', 'id'=>'arquivo-laudo']) !!}
							<input type="hidden" name="laudo_atual" value="{!! $atestado->no_laudo_fisico !!}">    
						</div>
				
					@endsection
				@else
					@section('laudo')
						<div id="row-laudo-input">
							{!! Form::file('laudo', ['class'=>'form-control input-large', 'id'=>'arquivo-laudo']) !!}    
						</div>
					@endsection
				@endif


			


			@else



				{!! Form::open(['route'=>'sismed::atestado.store', 'id'=>'formulario','files' => true, 'name'=>'formulario', 'enctype' => 'multipart/form-data']) !!}
				<input type="hidden" name="id_servidor" value="{!! $servidor->id_servidor !!}">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Novo Atestado</h3>
				</div>

				@section('anexo')
					<div id="row-anexo-input">
						{!! Form::file('atestado', ['class'=>'form-control input-large', 'id'=>'arquivo-atestado']) !!}    
					</div>
				@endsection

				@section('laudo')
					<div id="row-laudo-input">
						{!! Form::file('laudo', ['class'=>'form-control input-large', 'id'=>'arquivo-laudo']) !!}    
					</div>
				@endsection

			
			@endif

				
				<div class="modal-body">
					@include('errors.errors')
					@include('sismed::servidor.atestado._form',['submit_text' => 'Salvar'])

					<div class="table-pericia-container">
					 @include('sismed::servidor.atestado.pericia._tabela')
					</div>
				</div>
	        	
	        	<div class="modal-footer">
					{!! Form::submit('Salvar', ['class'=>'btn btn-primary', 'id' => 'btnFormSalvar']) !!}
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

</div>
<meta name="_token" content="{!! csrf_token() !!}"/>