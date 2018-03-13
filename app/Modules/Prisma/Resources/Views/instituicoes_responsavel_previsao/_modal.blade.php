<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">

			@if($mode == "update")
				{!! Form::model($instituicaoResponsavelPrevisao, ['route'=>['prisma::instituicoes_responsavel_previsao.update', $instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao], 'method'=>'put', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>
						Editar Instituição Responsável pela Previsão 
						<small>
					        <i class="ace-icon fa fa-angle-double-right"></i>
					        {{ $instituicaoResponsavelPrevisao->no_instituicao_responsavel_previsao }}
					    </small>
					</h3>
				</div>	
			@else
				{!! Form::open(['route'=>'prisma::instituicoes_responsavel_previsao.store', 'id'=>'formulario']) !!}
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>Criar Nova Instituição Responsável pela Previsão </h3>
				</div>	
			@endif

				<div class="modal-body">
					<p>O nome da instituição responsável por informar as previsões deve ser único e não pode conter espaços em branco.</p>
					@include('prisma::instituicoes_responsavel_previsao._form',['submit_text' => 'Salvar'])
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