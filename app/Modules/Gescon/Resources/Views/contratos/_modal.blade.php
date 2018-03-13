<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			{!! Form::open(['route'=>'gescon::modalidades.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Escolha o Tipo de Contrato </h3>
				</div>	
			
				<div class="modal-body">
					<div class="row">
					    <div class="col-sm-2">
							<div class="form-group">
							    <a href="{{route('gescon::contratos.terceirizacao.create', ['inObjeto' => 'BG'])}}">
								    <img src="{{ URL::asset('modules/gescon/icons/brigadista.png') }}" height="100" width="110">
							    </a>
							</div>
						</div>
						<div class="col-sm-1"></div>
					    <div class="col-sm-2">
							<div class="form-group">
							    <a href="{{route('gescon::contratos.terceirizacao.create', ['in_objeto' => 'TR'])}}">
								    <img src="{{ URL::asset('modules/gescon/icons/terceirizado.png') }}" height="100" width="110">
							    </a>
							</div>
						</div>
						<div class="col-sm-1"></div>
					    <div class="col-sm-2">
							<div class="form-group">
							    <a href="{{route('gescon::contratos.terceirizacao.create', ['in_objeto' => 'VG'])}}">
								    <img src="{{ URL::asset('modules/gescon/icons/vigilante.png') }}" height="100" width="110">
							    </a>
							</div>
						</div>
						<div class="col-sm-1"></div>
					    <div class="col-sm-2">
							<div class="form-group">
							    <a href="{{route('gescon::contratos.terceirizacao.create', ['in_objeto' => 'LP'])}}">
								    <img src="{{ URL::asset('modules/gescon/icons/limpeza.png') }}" height="100" width="110">
							    </a>
							</div>
						</div>
					</div>
				</div>
	        	
	        	<div class="modal-footer">
					
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