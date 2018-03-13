<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				@if(isset($id_proposicao))
					{!! Form::model($respostaMf, ['route'=>['parla::respostas_mf.update', $respostaMf->id_resposta_mf, $id_proposicao], 'method'=>'put', 'id'=>'formulario']) !!}
				@else
					{!! Form::model($respostaMf, ['route'=>['parla::respostas_mf.update', $respostaMf->id_resposta_mf], 'method'=>'put', 'id'=>'formulario']) !!}
				@endif
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Resposta do MF
					</h3>
				</div>

				@if($respostaMf->tx_arquivo)
					@section('arquivo')
						<input type="hidden" name="arquivo_delete" value="false">
						<input type="hidden" name="arquivo_atual" value="{!! $respostaMf->tx_arquivo !!}">
						<div id="row-arquivo">
							<a href="/uploads/parla/respostas/{{ $respostaMf->tx_arquivo }}" class="btn btn-minier btn-yellow">
							    <i class="ace-icon fa fa-pencil-square-o"></i>Arquivo atual
							    
							</a>
							<a href="#" class="btn btn-minier btn-danger" id="btn-excluir-documento">
							    <i class="ace-icon fa fa-trash-o"></i>Excluir
							</a>
						</div>
						<div id="row-arquivo-input" style="display: none">
							{!! Form::file('resposta',['class'=>'form-control input-large', 'id'=>'arquivo-resposta']) !!}  
						</div>
				
					@endsection
				@else
					@section('arquivo')
						<div id="row-arquivo-input">
							{!! Form::file('resposta',['class'=>'form-control input-large', 'id'=>'arquivo-resposta']) !!}  
						</div>
					@endsection
				@endif

			@else
				@if(isset($id_proposicao))
					{!! Form::open(['route'=>['parla::respostas_mf.store',$id_proposicao], 'id'=>'formulario']) !!}
				@else
					{!! Form::open(['route'=>'parla::respostas_mf.store', 'id'=>'formulario']) !!}
				@endif

				@section('arquivo')
					<div id="row-arquivo-input">
						{!! Form::file('resposta',['class'=>'form-control input-large', 'id'=>'arquivo-resposta']) !!}  
					</div>
				@endsection
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Nova Resposta do MF </h3>
				</div>	
			@endif

				<div class="modal-body">
					@include('parla::respostas_mf._form',['submit_text' => 'Salvar'])
				</div>
	        	
	        	<div class="modal-footer">
	        		@if(isset($id_proposicao))
						{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX_parla']) !!}
					@else
						{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX']) !!}
					@endif
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