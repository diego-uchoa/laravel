<div class="modal fade" id="modal-create" role="dialog" data-toggle="modal">
	
	<div class="modal-dialog">

		<div class="modal-content">
					{!! Form::model($instituicao, ['route'=>['prisma::instituicoes.update.nome_relatorio', $instituicao->id_instituicao], 'method'=>'put', 'id'=>'formulario']) !!}
					{!! Form::hidden('id_instituicao', $instituicao->id_instituicao) !!}
					<div class="modal-header">
						<a class="close" data-dismiss="modal">&times;</a>
						<h3>
							Editar nome em relatório
							<small>
						        <i class="ace-icon fa fa-angle-double-right"></i>
						        {{$instituicao->no_razao_social}}
						    </small>	
						</h3>
					</div>	

					<div class="modal-body">
						@include('prisma::instituicoes.edit.nome_relatorio._form',['submit_text' => 'Salvar'])
					</div>
		        	
		        	<div class="modal-footer">
						{!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnFormSalvarAJAX_prisma']) !!}
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