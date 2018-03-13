<div class="row" id="form-teste">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('nr_contrato', 'Nº Contrato:') !!}
			
			@if (isset($contrato))
				<h5><strong>{!! $contrato->nr_contrato !!}</strong></h5>
				{!! Form::hidden('nr_contrato', $contrato->nr_contrato, ['id' => 'nr_contrato']) !!}
			@else
				{!! Form::text('nr_contrato', null, ['class' => 'form-control input-mask-numero-contrato', 'id' => 'nr_contrato']) !!}
			@endif
		</div>
	</div>
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('co_uasg', 'UASG:') !!}
            {!! Form::hidden('id_contratante', null, ['class' => 'form-control', 'id' => 'id_contratante']) !!}
            
            @if (isset($contrato))
            	<h5><strong>{!! $contrato->co_uasg !!}</strong></h5>
            	{!! Form::hidden('co_uasg', $contrato->co_uasg, ['id' => 'co_uasg']) !!}
            @else
            	{!! Form::select('co_uasg', $listaUasg, null, ['class' => 'form-control', 'id' => 'co_uasg']) !!}
            @endif
		</div>
	</div>
	<div class="col-xs-8 col-sm-8">
		<div class="form-group">
			{!! Form::label('no_contratante', 'Contratante:') !!}
			{!! Form::hidden('id_contratante_representante', null, ['class' => 'form-control', 'id' => 'id_contratante_representante']) !!}
			{!! Form::text('no_contratante', isset($contrato) ? $contrato->contratante->orgao->no_orgao : null, ['class' => 'form-control', 'id' => 'no_contratante', 'readonly']) !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('nr_cpf', 'CPF:') !!}
			{!! Form::text('nr_cpf', isset($contrato) ? $contrato->contratante->representante_contrato->nr_cpf_representante : null, ['class' => 'form-control', 'id' => 'nr_cpf', 'readonly']) !!}
		</div>
	</div>
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('nr_rg', 'RG:') !!}
			{!! Form::text('nr_rg', isset($contrato) ? $contrato->contratante->representante_contrato->nr_rg_representante : null, ['class' => 'form-control', 'id' => 'nr_rg', 'readonly']) !!}
		</div>
	</div>
	<div class="col-xs-5 col-sm-5">
		<div class="form-group">
			{!! Form::label('no_representante_contratante', 'Representante da Contratante:') !!}
			{!! Form::text('no_representante_contratante', isset($contrato) ? $contrato->contratante->representante_contrato->no_representante : null, ['class' => 'form-control', 'id' => 'no_representante_contratante', 'readonly']) !!}
		</div>
	</div>
	<div class="col-xs-3 col-sm-3">
		<div class="form-group">
			{!! Form::label('ds_funcao', 'Função:') !!}
			{!! Form::text('ds_funcao', isset($contrato) ? $contrato->contratante->representante_contrato->ds_funcao_representante : null, ['class' => 'form-control', 'id' => 'ds_funcao', 'readonly']) !!}
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('in_tipo', 'Tipo Contrato:') !!}
			{!! Form::select('in_tipo', $listaTipoContrato, null, ['class' => 'form-control', 'id' => 'in_tipo']) !!}
		</div>
	</div>
	<div class="col-xs-3 col-sm-3">
		<div class="form-group">
			{!! Form::label('id_modalidade', 'Modalidade de Seleção:') !!}
			{!! Form::select('id_modalidade', $listaModalidade, null, ['class' => 'form-control', 'id' => 'id_modalidade']) !!}
		</div>
	</div>
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('nr_modalidade', 'Nº Modalidade:') !!}
			{!! Form::text('nr_modalidade', null, ['class' => 'form-control input-mask-numero-modalidade', 'id' => 'nr_modalidade']) !!}
		</div>
	</div>
</div>	
<div class="row">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('nr_processo', 'Nº Processo:') !!}
			{!! Form::text('nr_processo', null, ['class' => 'form-control input-mask-numero-processo', 'id' => 'nr_processo', 'data-rel' => 'tooltip', 'data-original-title' => isset($contrato) ? $contrato->nr_processo : null ]) !!}
		</div>
	</div>
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('nr_cronograma', 'Nº Cronograma:') !!}
			{!! Form::text('nr_cronograma', null, ['class' => 'form-control input-mask-numero-cronograma', 'id' => 'nr_cronograma']) !!}
		</div>
	</div>
</div>
<div class="row">
		
		@if (isset($contrato))
			@if($contrato->tx_arquivo_modalidade)
				<div class="col-xs-4 col-sm-4">
					<div class="form-group">
						<input type="hidden" name="arquivo_modalidade_delete" value="false">
						<input type="hidden" name="arquivo_modalidade_atual" value="{!! $contrato->tx_arquivo_modalidade !!}">
						<div id="row-arquivo-modalidade">
							<div class="form-group">
								{!! Form::label('arquivo-modalidade', 'Arquivo Edital:') !!}
								<br>
								<a href="/uploads/gescon/{{ $contrato->tx_arquivo_modalidade }}">
                                    <img height="60" width="60" style="height:60px;max-height:60px;min-height:60px" 
									src="{{ URL::asset('modules/gescon/icons/icon_contrato.png') }}">
								</a>
								<a href="#" class="btn btn-minier btn-danger" id="btn-excluir-documento-modalidade">
								    <i class="ace-icon fa fa-trash-o"></i>Excluir
								</a>
							</div>
						</div>
						<div id="row-arquivo-input-modalidade" style="display: none">
							{!! Form::label('arquivo-modalidade', 'Anexar Arquivo Edital:') !!}
							{!! Form::file('arquivo-modalidade',['class'=>'form-control input-large', 'id'=>'arquivo-modalidade']) !!}  
						</div>
					</div>
				</div>
			@else
				<div class="col-xs-4 col-sm-4">
					<div class="form-group">
						{!! Form::label('arquivo-modalidade', 'Anexar Arquivo Edital:') !!}
						{!! Form::file('arquivo-modalidade',['class'=>'form-control input-large', 'id'=>'arquivo-modalidade']) !!}  
					</div>
				</div>		
			@endif
		@else
			<div class="col-xs-4 col-sm-4">
				<div class="form-group">
					{!! Form::label('arquivo-modalidade', 'Anexar Arquivo Edital:') !!}
					{!! Form::file('arquivo-modalidade',['class'=>'form-control input-large', 'id'=>'arquivo-modalidade']) !!}  
				</div>
			</div>		
		@endif


		@if (isset($contrato))
			@if($contrato->tx_arquivo_contrato)
				<div class="col-xs-4 col-sm-4">
					<div class="form-group">
						<input type="hidden" name="arquivo_contrato_delete" value="false">
						<input type="hidden" name="arquivo_contrato_atual" value="{!! $contrato->tx_arquivo_contrato !!}">
						<div id="row-arquivo-contrato">
							<div class="form-group">
								{!! Form::label('arquivo-contrato', 'Arquivo Contrato:') !!}
								<br>
								<a href="/uploads/gescon/{{ $contrato->tx_arquivo_contrato }}">
								    <img height="60" width="60" style="height:60px;max-height:60px;min-height:60px" 
								    src="{{ URL::asset('modules/gescon/icons/icon_contrato.png') }}">
								</a>
								<a href="#" class="btn btn-minier btn-danger" id="btn-excluir-documento-contrato">
								    <i class="ace-icon fa fa-trash-o"></i>Excluir
								</a>
							</div>
						</div>
						<div id="row-arquivo-input-contrato" style="display: none">
							{!! Form::label('arquivo-contrato', 'Anexar Arquivo Contrato:') !!}
							{!! Form::file('arquivo-contrato',['class'=>'form-control input-large', 'id'=>'arquivo-contrato']) !!}  
						</div>
					</div>
				</div>
			@else
				<div class="col-xs-4 col-sm-4">
					<div class="form-group">
						{!! Form::label('arquivo-contrato', 'Anexar Arquivo Contrato:') !!}
						{!! Form::file('arquivo-contrato',['class'=>'form-control input-large', 'id'=>'arquivo-contrato']) !!}  
					</div>
				</div>		
			@endif
		@else
			<div class="col-xs-4 col-sm-4">
				<div class="form-group">
					{!! Form::label('arquivo-contrato', 'Anexar Arquivo Contrato:') !!}
					{!! Form::file('arquivo-contrato',['class'=>'form-control input-large', 'id'=>'arquivo-contrato']) !!}  
				</div>
			</div>		
		@endif


		@if (isset($contrato))
			@if($contrato->tx_arquivo_ata)
				<div class="col-xs-4 col-sm-4">
					<div class="form-group">
						<input type="hidden" name="arquivo_ata_delete" value="false">
						<input type="hidden" name="arquivo_ata_atual" value="{!! $contrato->tx_arquivo_ata !!}">
						<div id="row-arquivo-ata">
							<div class="form-group">
								{!! Form::label('arquivo-ata', 'Arquivo Ata:') !!}
								<br>
								<a href="/uploads/gescon/{{ $contrato->tx_arquivo_ata }}">
								    <img height="60" width="60" style="height:60px;max-height:60px;min-height:60px" 
								    src="{{ URL::asset('modules/gescon/icons/icon_contrato.png') }}">
								</a>
								<a href="#" class="btn btn-minier btn-danger" id="btn-excluir-documento-ata">
								    <i class="ace-icon fa fa-trash-o"></i>Excluir
								</a>
							</div>
						</div>
						<div id="row-arquivo-input-ata" style="display: none">
							{!! Form::label('arquivo-ata', 'Anexar Arquivo Ata:') !!}
							{!! Form::file('arquivo-ata',['class'=>'form-control input-large', 'id'=>'arquivo-ata']) !!}  
						</div>
					</div>
				</div>
			@else
				<div class="col-xs-4 col-sm-4">
					<div class="form-group">
						{!! Form::label('arquivo-ata', 'Anexar Arquivo Ata:') !!}
						{!! Form::file('arquivo-ata',['class'=>'form-control input-large', 'id'=>'arquivo-ata']) !!}  
					</div>
				</div>		
			@endif
		@else
			<div class="col-xs-4 col-sm-4">
				<div class="form-group">
					{!! Form::label('arquivo-ata', 'Anexar Arquivo Ata:') !!}
					{!! Form::file('arquivo-ata',['class'=>'form-control input-large', 'id'=>'arquivo-ata']) !!}  
				</div>
			</div>		
		@endif

</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="header smaller lighter grey">Assinador por</h5>
    </div>
</div>

<div class="row">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
			{!! Form::label('id_contratante_assinante', 'CPF:') !!}

			@if (!isset($contrato))
				{!! Form::select('id_contratante_assinante', $listaAssinante, null, ['class' => 'form-control', 'id' => 'id_contratante_assinante']) !!}
			@else
				{!! Form::hidden('id_contratante_assinante', isset($contrato) ? $contrato->assinante->id_contratante : null, ['class' => 'form-control', 'id' => 'id_contratante_assinante', 'readonly']) !!}
				{!! Form::text('nr_cpf_assinante', isset($contrato) ? $contrato->assinante->nr_cpf_assinante : null, ['class' => 'form-control', 'id' => 'nr_cpf_assinante', 'readonly']) !!}
			@endif
		</div>
	</div>
	<div class="col-xs-6 col-sm-6">
		<div class="form-group">
			{!! Form::label('no_assinante_contratante', 'Nome:') !!}
			{!! Form::text('no_assinante_contratante', isset($contrato) ? $contrato->assinante->no_assinante : null, ['class' => 'form-control', 'id' => 'no_assinante_contratante', 'readonly']) !!}
		</div>
	</div>
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
			{!! Form::label('ds_funcao_assinante', 'Função:') !!}
			{!! Form::text('ds_funcao_assinante', isset($contrato) ? $contrato->assinante->ds_funcao_assinante : null, ['class' => 'form-control', 'id' => 'ds_funcao_assinante', 'readonly']) !!}			
		</div>
	</div>
</div>	

@if (!isset($contrato))
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			{!! Form::button('<i class="fa fa-plus"></i> Assinante', ['class' => 'btn btn-sm btn-primary pull-right', 'data-rel' => 'tooltip', 'data-original-title' => 'Incluir Novo Assinante', 'id' => 'bt_novo_assinante', 'disabled']) !!}
		</div>
	</div>
@endif


@section('script-end')
    
    @parent

    <script type="text/javascript">
	    /********************************************************************************************************
	    Funções específicadas do STEP referente a CONTRATANTE
	    *********************************************************************************************************/
		var nr_contrato = "";
		var co_uasg = "";

		$.fn.file_campos = function() {        
			$('#arquivo-modalidade').ace_file_input({
				no_file:'Nenhum Arquivo ...',
				btn_choose:'Selecione',
				btn_change:'Alterar',
				allowExt: ["pdf"],
				allowMime: ["application/pdf", "report/pdf"],
				maxSize: 5000000,//bytes
				droppable:false,
				onchange:null,
				thumbnail:false
			})
			$('#arquivo-modalidade').on('file.error.ace', function(ev, info) {
				if(info.error_count['ext'] || info.error_count['mime']){

					bootbox.dialog({
					    message: '<p class="text-center">Tipo de Arquivo inválido! Permitido apenas arquivos do tipo PDF.</p>',
					    closeButton: true
					})

				}
				if(info.error_count['size']){

					bootbox.dialog({
					    message: '<p class="text-center">Tamanho do arquivo maior que o permitido! Max. 5Mb.</p>',
					    closeButton: true
					})

				}
				ev.preventDefault();
				$('#arquivo-modalidade').ace_file_input('reset_input');
			});


			$('#arquivo-contrato').ace_file_input({
				no_file:'Nenhum Arquivo ...',
				btn_choose:'Selecione',
				btn_change:'Alterar',
				allowExt: ["pdf"],
				allowMime: ["application/pdf", "report/pdf"],
				maxSize: 5000000,//bytes
				droppable:false,
				onchange:null,
				thumbnail:false
			})
			$('#arquivo-contrato').on('file.error.ace', function(ev, info) {
				if(info.error_count['ext'] || info.error_count['mime']){

					bootbox.dialog({
					    message: '<p class="text-center">Tipo de Arquivo inválido! Permitido apenas arquivos do tipo PDF.</p>',
					    closeButton: true
					})

				}
				if(info.error_count['size']){

					bootbox.dialog({
					    message: '<p class="text-center">Tamanho do arquivo maior que o permitido! Max. 5Mb.</p>',
					    closeButton: true
					})

				}
				ev.preventDefault();
				$('#arquivo-contrato').ace_file_input('reset_input');
			});;


			$('#arquivo-ata').ace_file_input({
				no_file:'Nenhum Arquivo ...',
				btn_choose:'Selecione',
				btn_change:'Alterar',
				allowExt: ["pdf"],
				allowMime: ["application/pdf", "report/pdf"],
				maxSize: 5000000,//bytes
				droppable:false,
				onchange:null,
				thumbnail:false
			})
			$('#arquivo-ata').on('file.error.ace', function(ev, info) {
				if(info.error_count['ext'] || info.error_count['mime']){

					bootbox.dialog({
					    message: '<p class="text-center">Tipo de Arquivo inválido! Permitido apenas arquivos do tipo PDF.</p>',
					    closeButton: true
					})

				}
				if(info.error_count['size']){

					bootbox.dialog({
					    message: '<p class="text-center">Tamanho do arquivo maior que o permitido! Max. 5Mb.</p>',
					    closeButton: true
					})

				}
				ev.preventDefault();
				$('#arquivo-ata').ace_file_input('reset_input');
			});
		}

		$.fn.excluir_arquivo_modalidade = function() {
		    $("#btn-excluir-documento-modalidade").click(function(){
		        bootbox.confirm("Deseja realmente excluir o arquivo de modalidade?", function(result){
		            if(result) {         
		                $('#row-arquivo-modalidade').hide();
		                $('#row-arquivo-input-modalidade').show();
		                $("input[name='arquivo_modalidade_delete']").val('true');
		            }
		        });
		    });
		};

		$.fn.excluir_arquivo_contrato = function() {
		    $("#btn-excluir-documento-contrato").click(function(){
		        bootbox.confirm("Deseja realmente excluir o arquivo do contrato?", function(result){
		            if(result) {         
		                $('#row-arquivo-contrato').hide();
		                $('#row-arquivo-input-contrato').show();
		                $("input[name='arquivo_contrato_delete']").val('true');
		            }
		        });
		    });
		};

		$.fn.excluir_arquivo_ata = function() {
		    $("#btn-excluir-documento-ata").click(function(){
		        bootbox.confirm("Deseja realmente excluir o arquivo da ata?", function(result){
		            if(result) {         
		                $('#row-arquivo-ata').hide();
		                $('#row-arquivo-input-ata').show();
		                $("input[name='arquivo_ata_delete']").val('true');
		            }
		        });
		    });
		};

		$(document).on('change','#co_uasg', function() {
     		if (nr_contrato != $('#nr_contrato').val() || co_uasg != $('#co_uasg').val()){
     			$.fn.carregarUasg_Contrato("{{ url('gescon/contratantes/recuperar-dados/') }}", "{{ url('gescon/contratos/recuperar-dados-ws/') }}", "{{ url('gescon/contratos/exists/') }}", "{{ url('gescon/contratos/deleted/') }}", "{{ url('gescon/contratos/reativar/') }}", "{{ url('gescon/contratos/recuperar-dados-bd/') }}", "{{ url('gescon/modalidades/list/') }}");
     			nr_contrato = $('#nr_contrato').val();
     			co_uasg = $('#co_uasg').val();
     		}
        });

		$(document).on('blur','#nr_contrato', function() {
			if (nr_contrato != $('#nr_contrato').val() || co_uasg != $('#co_uasg').val()){
     			$.fn.carregarUasg_Contrato("{{ url('gescon/contratantes/recuperar-dados/') }}", "{{ url('gescon/contratos/recuperar-dados-ws/') }}", "{{ url('gescon/contratos/exists/') }}", "{{ url('gescon/contratos/deleted/') }}", "{{ url('gescon/contratos/reativar/') }}", "{{ url('gescon/contratos/recuperar-dados-bd/') }}", "{{ url('gescon/modalidades/list/') }}");
     			nr_contrato = $('#nr_contrato').val();
     			co_uasg = $('#co_uasg').val();
     		}
		});

		//Ação responsável por preencher os campos do Assinante de acordo com a CPF escolhido
		$(document).on('change','#id_contratante_assinante', function() {
     		var v_url = "{{ url('gescon/contratante-assinante/recupera-dados-bd/') }}";
     		$.fn.busca_assinante_por_id($('#id_contratante_assinante'), v_url, function(retorno){
     		    if (retorno != ""){
     		        $('#no_assinante_contratante').val(retorno.no_assinante);
     		        $('#ds_funcao_assinante').val(retorno.ds_funcao_assinante);
     		    }else{
     		        $('#no_assinante_contratante').val('');
     		        $('#ds_funcao_assinante').val('');
     		    }
     		});
        });
		
     	$.fn.carregarMaskNumeroModalidade = function() {
			$('.input-mask-numero-modalidade').mask('9999/9999', {reverse: true});	
		}
		$.fn.carregarMaskNumeroProcesso = function() {
			$(".input-mask-numero-processo").mask('99999.999999/9999-99', {reverse: true});	
		}
     	$.fn.carregarMaskNumeroCronograma = function() {
			$('.input-mask-numero-cronograma').mask('9999/9999', {reverse: true});	
		}

		$.fn.setDisableContrato = function(state) {
			$("#nr_modalidade").prop("readonly", state);
			$("#nr_processo").prop("readonly", state);	    
			if (!state){
				$("#nr_modalidade").val('');
				$("#nr_processo").val('');
			}
		}

		$.fn.setDisableComboModalidade = function(valor) {
			$("#id_modalidade").css({'background-color': '#EEEEEE'});
			$("#id_modalidade").find('option').each(function(){
				if (valor != $(this).val()){
					$("#id_modalidade option[value='"+ $(this).val() +"']").remove();
				}
			});
		}

		$.fn.preencheComboModlidade = function(data) {
			$("#id_modalidade").css({'background-color': '#FFFFFF'});
			var selectboxModalidade = $('#id_modalidade');
			selectboxModalidade.find('option').remove();
			$.each(data, function (i, d) {
			    $('<option>').val(d.id).text(d.text).appendTo(selectboxModalidade);
			});
		}

		$.fn.setDisableContratante = function(state) {
			$("#no_contratante").prop("readonly", state);
			$("#nr_cpf").prop("readonly", state);
			$("#nr_rg").prop("readonly", state);
			$("#no_representante_contratante").prop("readonly", state);
			$("#ds_funcao").prop("readonly", state);
		}

		$.fn.setDisableBotaoNovoAssinante = function(state) {
			$("#bt_novo_assinante").prop("disabled", state);
		}

		$(document).on('click', '#bt_novo_assinante', function(){  
			$('#modal-create-assinante').modal('show');
		});
	</script>

@endsection