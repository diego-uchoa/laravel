<div class="col-sm-8">


<div class="modal fade" id="modal-create" role="dialog">
@if(isset($pericia))	
	
	<div class="modal-dialog">
		
		<div class="modal-content">

				{!! Form::model($pericia, ['route'=>['sismed::atestado.pericia.update', $pericia->id_pericia], 'method'=>'put','id'=>'formulario-pericia', 'name'=>'formulario-pericia', 'enctype' => 'multipart/form-data']) !!}
				<input type="hidden" name="id_atestado" value="{!! $pericia->id_atestado !!}">
				<input type="hidden" name="id_servidor" value="{!! $atestado->id_servidor !!}">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Editar Perícia</h3>
				</div>
				
				<!-- Arquivo Laudo -->
				@if($pericia->no_laudo_fisico)
					@section('laudo')
						<input type="hidden" name="laudo_delete" value="false"> 
						<input type="hidden" name="laudo_atual" value="{!! $pericia->no_laudo_fisico !!}">
						<div id="row-laudo">
							
							<a href="/uploads/sismed/{{ $servidor->co_prontuario }}/{{ $pericia->no_laudo_fisico }}" class="btn btn-minier btn-yellow" target="_blank">
							    <i class="ace-icon fa fa-stethoscope"></i>Laudo
							</a>
							<a href="#" class="btn btn-minier btn-danger" id="btn-exclur-laudo-pericia">
							    <i class="ace-icon fa fa-trash-o"></i>Excluir
							</a>
						</div>
						<div id="row-laudo-input-pericia" style="display: none">
							{!! Form::file('laudo', ['class'=>'form-control input-large', 'id'=>'arquivo-laudo']) !!}
							<input type="hidden" name="laudo_atual" value="{!! $pericia->no_laudo_fisico !!}">    
						</div>
				
					@endsection
				@else
					@section('laudo')
						<div id="row-laudo-input">
							{!! Form::file('laudo', ['class'=>'form-control input-large', 'id'=>'arquivo-laudo']) !!}    
						</div>
					@endsection
				@endif

				
				<div class="modal-body">
					@include('errors.errors')
					@include('sismed::servidor.atestado.pericia._form',['submit_text' => 'Salvar'])

				</div>
	        	
	        	<div class="modal-footer">
					{!! Form::button('Salvar', ['class'=>'btn btn-primary', 'id' => 'btnFormSalvarAJAX-pericia']) !!}
				</div>
				

	        {!! Form::close() !!}

	        	<div id='snippet'>
				   
				</div>

				<!-- In case that we want redraw section-->
				<div id='mySection'>
				    
				</div>

		</div>

	</div>

@endif
</div>

</div>
<meta name="_token" content="{!! csrf_token() !!}"/>