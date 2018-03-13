@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::contratantes.index') !!}

@endsection

@section('content')
	
		<div class="widget-box">
			<div class="widget-header widget-header-blue widget-header-flat">
				<h4 class="widget-title lighter">Etapas do Contrato de {{ $ds_objeto }}</h4>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					<div id="fuelux-wizard-container">
						    <ul class="steps">
					        <li data-step="1" class="active">
					            <span class="step">1</span>
					            <span class="title">Dados Iniciais</span>
					        </li>
					        <li data-step="2">
					            <span class="step">2</span>
					            <span class="title">Contratada</span>
					        </li>
					        <li data-step="3">
					            <span class="step">3</span>
					            <span class="title">Contratação</span>
					        </li>
					        <li data-step="4">
					            <span class="step">4</span>
					            <span class="title">Datas/Pagamentos/Variação</span>
					        </li>

					        <li data-step="5">
					            <span class="step">5</span>
					            <span class="title">Fiscais</span>
					        </li>

					        <li data-step="6">
					            <span class="step">6</span>
					            <span class="title">Outras Informações</span>
					        </li>
					    </ul>
					    <hr />
					    <div class="step-content pos-rel">

					    	{!! Form::open(['route'=>'gescon::contratos.terceirizacao.store', 'id'=>'formulario']) !!}
		                    	
		                    	{!! Form::hidden('in_objeto', $inObjeto, ['class' => 'form-control', 'id' => 'in_objeto']) !!}
		                    	<div class="alert alert-danger" id="alert-step" style="display:none">
		        	            	<strong>
		        	            		<i class="ace-icon fa fa-times"></i>
		        	            		Atenção!
		        	            	</strong>
		        	            		Os campos em vermelho são de preenchimento obrigatório.
		        	            	<br/>
		                    	</div>

					    		<div class="step-pane active" data-step="1" id="step-1">
						            <h3 class="lighter block blue">Dados Iniciais do Contrato</h3>
										@include('gescon::contratos._form_contratante')
						        </div>
						    
						        <div class="step-pane" data-step="2" id="step-2">
						            <h3 class="lighter block blue">Dados da Contratada</h3>
						            	@include('gescon::contratos._form_contratada')
						        </div>

						        <div class="step-pane" data-step="3" id="step-3">
						            <h3 class="lighter block blue">Dados da Contratação</h3>
						            	@include('gescon::contratos.terceirizacao._form_contratacao')
						        </div>

								<div class="step-pane" data-step="4" id="step-4">
								    <h3 class="lighter block blue">Dados das Datas, Processo de Pagamento e Variação</h3>
								    	@include('gescon::contratos._form_data_pagamento_variacao')
								</div>							        

								<div class="step-pane" data-step="5" id="step-5">
								    <h3 class="lighter block blue">Dados de Garantia e Fiscais</h3>
								    	@include('gescon::contratos._form_fiscal')
								</div>							        

								<div class="step-pane" data-step="6" id="step-6">
								    <h3 class="lighter block blue">Outras Informações</h3>
								    	@include('gescon::contratos._form_informacoes_adicionais')
								</div>							        

						    {!! Form::close() !!}

						    <!--
								MODAL RESPONSÁVEL POR CADASTRAR O ASSINANTE DO CONTRATO
							-->
						    <div class="formulario-container">
						        @include('gescon::contratos._modal_assinante')
						    </div>

					    </div>
					</div>
					<hr />
					<div class="wizard-actions">
					    <button class="btn btn-prev">
					        <i class="ace-icon fa fa-arrow-left"></i>Anterior
					    </button>
					    <button class="btn btn-success btn-next" data-last="Finalizar">
					        Próximo<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					    </button>
					</div>
				</div>
			</div>
		</div>

@endsection

@section('script-end')
    
    @parent
	
	<!-- page specific plugin scripts -->
	<script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/wizard.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.validate.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.maskTelefone.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.maskMoney.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.inputlimiter.1.3.1.min.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/mask_contratada.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/ajax_busca_cep.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/ajax_lista_municipios.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/ajax_busca_contratada.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/ajax_busca_dados_fiscal.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/ajax_busca_assinante_por_id.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/contratos/ajax_busca_contrato.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/contratos/validate_campos_contrato_terceirizacao.js') }}"></script>
	<script src="{{ URL::asset('modules/gescon/js/contratos/validate_wizard_contrato_terceirizacao.js') }}"></script>
	<script src="{{ URL::asset('js/select.js') }}"></script>
	

    <script type="text/javascript">
        jQuery(function($) {                
        	
        	/***********************************************************************************************
        	//FUNCIONALIDADES ESPECÍFICAS DO WIZARD
        	************************************************************************************************/
        	$('#fuelux-wizard-container')
		        .ace_wizard()
		        .on('actionclicked.fu.wizard' , function(e, info){
		        	if (info.direction === 'previous') {
        	            return;
        	        }else{
        	           	if (info.step == 6){
        	           		return;	
        	           	}else{
           		           	var form = $("#formulario");
           					$.fn.validaCampos(e, info, form);		
        	           	}
        	        }
		        })
		        .on('finished.fu.wizard', function(e) {

		        	//Função específicas para verificar se os campos da Aba Outras Informações foram informados mas não foram adicionados na lista
		        	//       e enviar o formulário para inclusão
		        	$.fn.verificaPreenchimentoCamposOutrasInformacoes(e);
	                
		        });
			
			//Função responsável por gravar os dados do Contrato
			$.fn.enviarFormulario = function(){
				var url = document.getElementById("formulario").action;
				var form = new FormData();
				$.fn.desabilitarTodosCampos();

				//Recuperando os arquivos de upload, se houver
				var qtd_input_files = $('#formulario input[type="file"]').length;
				for (var i = 0; i < qtd_input_files; i++)
				{
				    var qtd_files = $('#formulario input[type="file"]')[i].files.length;   
				    var name = $('#formulario input[type="file"]')[i].name;
				    for (var j = 0; j < qtd_files; j++)
				    {
				        form.append(name, $('#formulario input[type="file"]')[i].files[j]);   
				    }
				}

				//Recuperando os dados do formulário
				var formData = $('#formulario').serializeArray();    
				jQuery.each( formData, function( i, field ) {
				    form.append(field.name, field.value);   
				});

				$.ajax({
				    url: url,
				    type: 'POST',
				    data: form,
				    dataType: 'json',
				    contentType: false, 
				    processData: false,
				    
				    beforeSend: function() {
				        dialogCreate = bootbox.dialog({
				            title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
				            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
				            closeButton: true
				        });
				    },
				    success: function(data) {
				        dialogCreate.init(function(){
				            if (data.status == "success"){
				                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
				                dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
				                
				                setTimeout(function(){
				                	dialogCreate.modal('hide');
				                }, 3000);
				                
				                window.location.href = data.redirect_url;
				            }else{
				                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
				                var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
				                if (typeof data.detail != "undefined"){
				                    aviso = aviso + '<ul class="list-unstyled spaced">';    
				                    aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
				                    aviso = aviso + '</ul>';        
				                }
				                dialogCreate.find('.bootbox-body').html(aviso);
				            }
				        });    

				    },
				    error: function(data){
				        if (typeof data.responseJSON == "undefined"){
				            var erro = '<ul class="list-unstyled spaced">';    
				            erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
				            erro = erro + '</ul>';    
				        }else{
				            var result = $.parseJSON(data.responseJSON.detail);
				            var erro = '<ul class="list-unstyled spaced">';
				            $.each(result, function(i, field){
				                erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
				            });
				            erro = erro + '</ul>';    
				        }

				        dialogCreate.init(function(){
				            dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
				            dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
				        });    
				        
				    }
				})
			}

			//Função responsável por gravar o assinante na tabela "contratante_assinante" e vinculá-lo no contrato
			$('.store_assinante').click(function(){
				$('#id_contratante_contrato').val($("#id_contratante").val());

				var url = document.getElementById('formulario_assinante').action;
				var form = new FormData();
				$.fn.desabilitarCamposAssinante();

				//Recuperando os dados do formulário
				var formData = $('#formulario_assinante').serializeArray();    
				jQuery.each( formData, function( i, field ) {
				    form.append(field.name, field.value);   
				});

				$.ajax({
				    url: url,
				    type: 'POST',
				    data: form,
				    dataType: 'json',
				    contentType: false, 
				    processData: false,
				    
				    beforeSend: function() {
				        dialogCreate = bootbox.dialog({
				            title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
				            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
				            closeButton: true
				        });
				    },
				    success: function(data) {
				        dialogCreate.init(function(){
				            if (data.status == "success"){
				                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
				                dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
				                
				                setTimeout(function(){
				                	dialogCreate.modal('hide');
				                }, 3000);

				                $.fn.preencheComboAssinante(data.html);
				                $.fn.fechaModalAssinante();

				            }else{
				                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
				                var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
				                if (typeof data.detail != "undefined"){
				                    aviso = aviso + '<ul class="list-unstyled spaced">';    
				                    aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
				                    aviso = aviso + '</ul>';        
				                }
				                dialogCreate.find('.bootbox-body').html(aviso);
				            }
				        });    

				    },
				    error: function(data){
				        if (typeof data.responseJSON == "undefined"){
				            var erro = '<ul class="list-unstyled spaced">';    
				            erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
				            erro = erro + '</ul>';    
				        }else{
				            var result = $.parseJSON(data.responseJSON.detail);
				            var erro = '<ul class="list-unstyled spaced">';
				            $.each(result, function(i, field){
				                erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
				            });
				            erro = erro + '</ul>';    
				        }

				        dialogCreate.init(function(){
				            dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
				            dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
				        });    
				        
				    }
				})
			});

			//Função responsável por fechar a Modal de Assinante e limpar os campos
			$.fn.fechaModalAssinante = function(){
				$('#modal-create-assinante').modal('hide');

				$('#modal-create-assinante').on('hidden.bs.modal', function () {
				    $(this).find("input,textarea,select").val('').end();

				});
			}
	
			//Função responsável por preencher a Combobox de Assinante pelo Assinante responsável cadastrado
			$.fn.preencheComboAssinante = function(data) {
				var selectboxAssinante = $('#id_contratante_assinante');
				$('<option>').val(data.id_contratante_assinante).text(data.nr_cpf_assinante).appendTo(selectboxAssinante);
			    $('#id_contratante_assinante option[value="' + data.id_contratante_assinante + '"]').attr({ selected : "selected" });
			    $('#no_assinante_contratante').val(data.no_assinante);
				$('#ds_funcao_assinante').val(data.ds_funcao_assinante);
			}

			//Função responsável por desabilitar os campos da Modal Assinante
		   	$.fn.desabilitarCamposAssinante = function() {
				$('#no_assinante').prop("disabled", false);
		   	}

		    //Função responsável por realizar a validação dos campos do WIZARD
		    $.fn.validaCampos = function(e, info, form){
		    	$.fn.validacaoCamposStepCorrente(e, info, form);
		    	if (!form.valid()){
		    		e.preventDefault();	
		    		$('#alert-step').show()
		    	}else{
		    		$('#alert-step').hide();
		    		$.fn.validacaoCamposStepProxima(info, form);
		    	}
		    }

		    //Função responsável por ignorar a validação de campos do STEP CORRENTE
		    $.fn.validacaoCamposStepCorrente = function(e, info, formulario) {
		   		var step_atual = info.step;
		   		var steps = formulario.find(".step-pane");
		   		for (i = step_atual; i < steps.length; i++){
		   			fields = formulario.find('#'+steps[i].id).find(":input");
		   			fields.each(function( index ) {
		   				var id_campo = fields[index].id;
						if (id_campo.indexOf('[]') == -1){
							$('#'+fields[index].id).addClass("ignore");	
						}
					});

		   		}

		   		//Função específicas para verificar se os campos da listagem foram preenchidos mas não incluídos na lista
		   		$.fn.verificaPreenchimentoCamposListaByStep(e, formulario, step_atual);
		   		
		   		//Função específicas para campos tratados por um botão diferente do 'Próximo'
		   		$.fn.ignorarValidacaoEspecificaCamposByStep(formulario, step_atual);
		   	}

		   	//Função responsável por validade os campos do próximo STEP
		   	$.fn.validacaoCamposStepProxima = function(info, formulario) {
		   		var step_proximo = info.step + 1;
	   			fields = formulario.find('#step-'+step_proximo).find(":input");
				fields.each(function( index ) {
					var id_campo = fields[index].id;
					if (id_campo.indexOf('[]') == -1){
						$('#'+fields[index].id).removeClass("ignore");
					}
				});
		   	}

		   	$.fn.desabilitarTodosCampos = function() {
				$('#formulario input,select,textarea').each(function(){
					$(this).prop("disabled", false);
				});
		   	}

		   	//Métodos responsáveis pela funcionalidade de Data (Calendário)
		   	$.fn.data_picker = function() {
		   	    $('.date-picker').datepicker({
		   	        autoclose: true,
		   	        todayHighlight: true
		   	  
		   	    });

		   	    $('.data_limite').datepicker('setEndDate', new Date().toDateString())
		   	        .on('show', function(){
		   	            $('td.day.disabled').each(function(index, element){
		   	                var $element = $(element)
		   	                $element.attr("title", "A data não pode ser superior à atual");
		   	                $element.data("container", "body");
		   	                $element.tooltip()
		   	            });
		   	        });

		   	    $('.data_futura').datepicker('setStartDate', new Date().toDateString())
		   	        .on('show', function(){
		   	            $('td.day.disabled').each(function(index, element){
		   	                var $element = $(element)
		   	                $element.attr("title", "A data não pode ser inferior à atual");
		   	                $element.data("container", "body");
		   	                $element.tooltip()
		   	            });
		   	        });
		   	};

			/***********************************************************************************************
			//CARREGAMENTO DAS FUNCIONALIDADES/MASCARAS
			************************************************************************************************/
			$(document).ready(function() {
			    $('.input-mask-cpf').mask('999.999.999-99');
			    $('.input-mask-cep').mask('99.999-999');
			    $(".input-mask-money").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			    $('.input-mask-numero-portaria').mask('999/9999');
			    $('.input-mask-numero-boletim').mask('999/9999');
			    $('.input-mask-numero-modalidade').mask('9999/9999');
			    $('.input-mask-numero-cronograma').mask('9999/9999');
			    $('.input-mask-numero-contrato').mask('9999/9999');
			    $('.input-mask-numero-processo').mask('99999.999999/9999-99');
			    $('.input-mask-numero-nota_empenho').mask('999999');
			    $('.input-mask-numero-elemento_despesa').mask('999999');
			    $('.input-mask-numero-matricula-siape').mask('9999999');
			    $('.input-mask-ano').mask('9999');
			    $.fn.mascaraTelefone();
			    $.fn.change_Campo_CPF_CNPJ();
			    $.fn.data_picker();
			    $.fn.file_campos();
			    $('#maskZone').hide();
			});
	    });

	</script>

@endsection