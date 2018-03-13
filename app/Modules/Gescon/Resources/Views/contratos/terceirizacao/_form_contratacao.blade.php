<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
			{!! Form::label('ds_objeto', 'Descrição do Objeto:') !!}
			{!! Form::text('ds_objeto', null, ['class' => 'form-control', 'id' => 'ds_objeto']) !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
			{!! Form::label('ds_informacao_complementar', 'Informações Complementares:') !!}
			{!! Form::textarea('ds_informacao_complementar', null, ['class' => 'form-control limited', 'id' => 'ds_informacao_complementar', 'size' => '30x4', 'maxlength' => '500']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
		    {!! Form::label('vl_mensal', 'Valor Mensal:') !!}
		    <strong><i class="ace-icon fa fa-question-circle" data-rel='tooltip' data-original-title='Campo preenchido automaticamente de acordo com os valores dos Itens da Contratação.'></i></strong> 
		    {!! Form::text('vl_mensal', null, ['class' => 'form-control', 'id' => 'vl_mensal', 'readonly']) !!}
		</div>		
	</div>
	<div class="col-xs-3 col-sm-3"></div>
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
		    {!! Form::label('vl_anual', 'Valor Anual:') !!}
		    {!! Form::text('vl_anual', null, ['class' => 'form-control input-mask-money', 'id' => 'vl_anual']) !!}
		</div>		
	</div>
	<div class="col-xs-3 col-sm-3"></div>
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
		    {!! Form::label('vl_global', 'Valor Global:') !!}
		    {!! Form::text('vl_global', null, ['class' => 'form-control input-mask-money', 'id' => 'vl_global']) !!}
		</div>		
	</div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="row header smaller lighter grey">
    		<span class="col-sm-12">
    			Itens da Contratação
    		</span>	
        </h5>
    </div>
</div>

<div class="row row_item">
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('id_unidade_atendida', 'Unidade Atendida:') !!}
            {!! Form::hidden('id_unidade_atendida', null, ['class' => 'form-control', 'id' => 'id_unidade_atendida']) !!}
            <div class="input-group">
                {!! Form::text('ds_unidade_atendida', null, ['class' => 'form-control', 'id' => 'ds_unidade_atendida']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" data-rel="tooltip" data-original-title="Buscar Órgão" id="bt_buscar_orgao" name="bt_buscar_orgao">
                        <i class="fa fa-search bigger-110"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('id_edificio_atendido', 'Edifício Atendido:') !!}
            {!! Form::hidden('id_edificio_atendido', null, ['class' => 'form-control', 'id' => 'id_edificio_atendido']) !!}
            <div class="input-group">
                {!! Form::text('ds_edificio_atendido', null, ['class' => 'form-control', 'id' => 'ds_edificio_atendido']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" data-rel="tooltip" data-original-title="Buscar Edifício" id="bt_buscar_edificio" name="bt_buscar_edificio">
                        <i class="fa fa-search bigger-110"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('id_tipo_item', 'Tipo:') !!}
            {!! Form::hidden('id_tipo_item', null, ['class' => 'form-control', 'id' => 'id_tipo_item']) !!}
            <div class="input-group">
                {!! Form::text('ds_tipo_item', null, ['class' => 'form-control', 'id' => 'ds_tipo_item']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" data-rel="tooltip" data-original-title="Buscar Tipo de Item" id="bt_buscar_tipo_item" name="bt_buscar_tipo_item">
                        <i class="fa fa-search bigger-110"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-1">
        <div class="form-group">
            {!! Form::label('qt_item_contratacao', 'Quantidade:') !!}
            {!! Form::number('qt_item_contratacao', null, ['class' => 'form-control', 'id' => 'qt_item_contratacao']) !!}
        </div>
    </div>
    <div class="col-lg-1">
        <div class="form-group">
            {!! Form::label('id_unidade_medida', 'Medida:') !!}
            {!! Form::select('id_unidade_medida', $listaUnidadeMedida, null, ['class' => 'form-control', 'id' => 'id_unidade_medida']) !!}
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('vl_item_contratacao', 'Valor Unitário:') !!}
            {!! Form::text('vl_item_contratacao', null, ['class' => 'form-control input-mask-money', 'id' => 'vl_item_contratacao']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        {!! Form::button('<i class="fa fa-plus"></i> Item', ['class'=>'btn btn-sm btn-primary pull-right', 'data-rel' => 'tooltip', 'data-original-title' => 'Incluir Novo Item', 'id' => 'adiciona-item', 'name' => 'adiciona-item']) !!}
    </div>
</div>
<br>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="widget-box widget-color-grey" id="div-itens">
			<div class="widget-header widget-header-small">
			    <h5 class="widget-title smaller">Itens Adicionados</h5>
			</div>
		    <div class="widget-body">
		        <div class="widget-main no-padding">
		        	<table class="table table-striped table-bordered table-hover" id="lista-itens">
		        		<tbody>
		        			<tr>
				            	<th style="text-align:center">Unidade</th>
		        				<th style="text-align:center">Edifício</th>
		        				<th style="text-align:center">Tipo</th>
		        				<th style="text-align:center">Quantidade</th>
		        				<th style="text-align:center">Medida</th>
		        				<th style="text-align:center">Vlr Unit.</th>
		        				<th style="text-align:center">Vlr Mensal</th>
		        				<th style="text-align:center">Ação</th>
		        			</tr>

                            @if (isset($contrato))

                            	@php
                            		$var = 0;
                            	@endphp

                            	@foreach ($contrato->itensContratacao as $itemContratacao)

                            		<tr>
	                            		<td width="25%">
	                            			<input id="st_item_contratacao_novo[]" name="st_item_contratacao_novo[]" type="hidden" value="N">
	                            			<input id="id_unidade_atendida_adicionada[]" name="id_unidade_atendida_adicionada[]" type="hidden" value="{{ $itemContratacao->id_orgao }}">{{ $itemContratacao->orgao->sg_orgao ?? ' - ' }}
	                            		</td>
	                            		<td width="25%">
	                            			<input id="id_edificio_atendido_adicionada[]" name="id_edificio_atendido_adicionada[]" type="hidden" value="{{ $itemContratacao->id_edificio }}">{{ $itemContratacao->edificio->no_edificio ?? ' - ' }}
	                            		</td>
	                            		<td width="15%">
	                            			<input id="id_tipo_item_adicionada[]" name="id_tipo_item_adicionada[]" type="hidden" value="{{ $itemContratacao->id_tipo_item_contratacao }}">{{ $itemContratacao->tipoItemContratacao->ds_tipo_item_contratacao }}
	                            		</td>
	                            		<td width="5%" style="text-align: right">
	                            			<input id="qt_item_contratacao_adicionada[]" name="qt_item_contratacao_adicionada[]" type="hidden" value="{{ $itemContratacao->qt_item_contratacao }}">{{ $itemContratacao->qt_item_contratacao }}
	                            		</td>
	                            		<td width="5%" style="text-align: right">
	                            			<input id="id_unidade_medida_item_contratacao_adicionada[]" name="id_unidade_medida_item_contratacao_adicionada[]" type="hidden" value="{{ $itemContratacao->id_unidade_medida_item_contratacao }}">{{ $itemContratacao->unidadeMedidaItemContratacao->sg_unidade_medida_item_contratacao }}
	                            		</td>
	                            		<td width="10%" style="text-align: right">
	                            			<input id="vl_item_contratacao_adicionada[]" name="vl_item_contratacao_adicionada[]" type="hidden" value="{{ $itemContratacao->vl_item_contratacao }}">{{ GesconHelper::maskMoney($itemContratacao->vl_item_contratacao) }}
	                            		</td>
	                            		<td width="10%" style="text-align: right">
	                            			<input id="vl_total_item_contratacao_adicionada[]" name="vl_total_item_contratacao_adicionada[]" type="hidden" value="{{ $itemContratacao->vl_item_contratacao }}">{{ GesconHelper::maskMoney($itemContratacao->vl_item_contratacao * $itemContratacao->qt_item_contratacao) }}
	                            		</td>
	                            		
	                            		<td width="5%" style="text-align:center">
	                            			<a href='#' data-id='{{ $itemContratacao->id_contrato_item_contratacao_terceirizacao }}' data-url="{{ url('gescon/contratos/terceirizacao/item-contratacao/destroy/'). '/' .$itemContratacao->id_contrato_item_contratacao_terceirizacao }}" data-rel="tooltip" data-original-title="Excluir Item" class='btn btn-xs btn-danger btn-remove-item-ajax'>
	                            			    <i class='ace-icon fa fa-trash-o'></i>
	                            			</a>
	                            		</td>
	                            	</tr>

	                            	@php

	                            		$var += ($itemContratacao->qt_item_contratacao * $itemContratacao->vl_item_contratacao);

	                            	@endphp

                            	@endforeach

                            @endif

		        		</tbody>
		        		<tfoot>
		        			<tr>
				            	<th colspan='6' style='text-align: right'>Total Mensal</th>
	        					<th style='text-align: right'><span id='vlr_geral'>{!! isset($var) ? GesconHelper::maskMoney($var) : 0 !!}</span></th>
		        				<th></th>
		        			</tr>	
		        		</tfoot>
		        	</table>
		        </div>
		    </div>
		</div>
    </div>
</div>

<div class="formulario-container">
    @include('gescon::contratos._modal_orgao')
    @include('gescon::contratos._modal_edificio')
    @include('gescon::contratos._modal_tipo_item')
</div>

@section('script-end')
    @parent

    <script src="{{ URL::asset('js/select.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){      
            
            $.fn.ignorarValidacaoEspecificaCamposByStep = function(formulario, step_atual){
    			$.fn.ignorarValidacaoCamposPreposto(formulario, step_atual);
    			$.fn.ignorarValidacaoCamposItens(formulario, step_atual);
    			$.fn.ignorarValidacaoCamposProcessosPagamento(formulario, step_atual);
    			$.fn.ignorarValidacaoCamposOutrasInformacoes(formulario, step_atual);
    			$.fn.ignorarValidacaoCamposFiscais(formulario, step_atual);
    	   	}

   	        $.fn.verificaPreenchimentoCamposListaByStep = function(e, formulario, step_atual){
   				$.fn.verificaPreenchimentoCamposPreposto(e, formulario, step_atual);
   				$.fn.verificaPreenchimentoCamposItens(e, formulario, step_atual);
   				$.fn.verificaPreenchimentoCamposProcessosPagamento(e, formulario, step_atual);
   				$.fn.verificaPreenchimentoCamposFiscais(e, formulario, step_atual);
   		   	}

            $('#adiciona-item').click(function(){  
            	if ($('#id_unidade_atendida').val() == ''){
            		var id_unidade = '';
            		var ds_unidade = ' - ';
            	}else{
            		var id_unidade = $('#id_unidade_atendida').val();	
            		var ds_unidade = $('#ds_unidade_atendida').val();
            	}

            	if ($('#id_edificio_atendido').val() == ''){
            		var id_edificio = '';
            		var ds_edificio = ' - ';
            	}else{
            		var id_edificio = $('#id_edificio_atendido').val();	
            		var ds_edificio = $('#ds_edificio_atendido').val();
            	}

				var id_tipo_item = $('#id_tipo_item').val();
				var ds_tipo_item = $('#ds_tipo_item').val();
				var id_unidade_medida_item_contratacao = $('#id_unidade_medida').val();
				var ds_unidade_medida_item_contratacao = $('#id_unidade_medida :selected').text();
				var qt_item_contratacao = $('#qt_item_contratacao').val();
				var vl_item_contratacao = $('#vl_item_contratacao').val();

				if ($.fn.validacaoCamposItens()){
	            	
					var newRow = $("<tr>");		    
					var cols = "";		
					cols += '<td width="25%">';
						cols += '<input id="st_item_contratacao_novo[]" name="st_item_contratacao_novo[]" type="hidden" value="S">';
						cols += '<input id="id_unidade_atendida_adicionada[]" name="id_unidade_atendida_adicionada[]" type="hidden" value="'+ id_unidade +'">'+ ds_unidade;
					cols += '</td>';
					cols += '<td width="25%">';
						cols += '<input id="id_edificio_atendido_adicionada[]" name="id_edificio_atendido_adicionada[]" type="hidden" value="'+ id_edificio +'">'+ ds_edificio;
					cols += '</td>';
					cols += '<td width="15%">';
						cols += '<input id="id_tipo_item_adicionada[]" name="id_tipo_item_adicionada[]" type="hidden" value="'+ id_tipo_item +'">'+ ds_tipo_item;
					cols += '</td>';
					cols += '<td width="5%" style="text-align: right">';
						cols += '<input id="qt_item_contratacao_adicionada[]" name="qt_item_contratacao_adicionada[]" type="hidden" value="'+ qt_item_contratacao +'">'+ qt_item_contratacao;
					cols += '</td>';
					cols += '<td width="5%" style="text-align: right">';
						cols += '<input id="id_unidade_medida_item_contratacao_adicionada[]" name="id_unidade_medida_item_contratacao_adicionada[]" type="hidden" value="'+ id_unidade_medida_item_contratacao +'">'+ ds_unidade_medida_item_contratacao;
					cols += '</td>';
					cols += '<td width="10%" style="text-align: right">';
						cols += '<input id="vl_item_contratacao_adicionada[]" name="vl_item_contratacao_adicionada[]" type="hidden" value="'+ vl_item_contratacao +'">'+ vl_item_contratacao;
					cols += '</td>';
					cols += '<td width="10%" style="text-align: right">';
						cols += $.fn.formataValorReal(parseInt(vl_item_contratacao.replace(/[\D]+/g,'')) * qt_item_contratacao);
					cols += '</td>';
					cols += '<td width="5%" style="text-align:center">';
						cols += '<button type="button" class="btn btn-xs btn-danger btn-remove-item pull-center" data-rel="tooltip" data-original-title="Excluir Item"><i class="ace-icon fa fa-trash-o"/></button>';
					cols += '</td>';
				    
				    newRow.append(cols);
				    $("#lista-itens").append(newRow);
				    
				    $.fn.somaTotalGeral(vl_item_contratacao, qt_item_contratacao);
				
	             	$.fn.setValorVazioItemContratacao();
				}else{
					$('#alert-step').show();
				}
            })

			$.fn.somaTotalGeral = function(valor, quantidade){

				var vlr_geral = parseInt($('#vlr_geral').html().replace(/[\D]+/g,''));
				var vlr_geral_resultado	= (parseInt(valor.replace(/[\D]+/g,'')) * quantidade) + vlr_geral;
				$('#vlr_geral').html($.fn.formataValorReal(vlr_geral_resultado));	
				$('#vl_mensal').val($.fn.formataValorReal(vlr_geral_resultado));

			}

			$.fn.formataValorReal = function(valor){	        
	        	var tmp = valor+'';
		        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
		        if( tmp.length > 6 )
		           tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

		      	return tmp;
			}

			$(document).on('click', '.btn-remove-item', function(){  
			    var tr = $(this).closest('tr');
			    bootbox.confirm("Deseja realmente excluir o registro?", function(result){
			    	if (result){
			    		$.fn.removeItemContratacao(tr);	
			    	}
				});
			}); 

		    $(document).on('click', '.btn-remove-item-ajax', function(){  
		        var url_destroy = $(this).data("url");
		        var id_registro = $(this).data("id");
		        var tr = $(this).closest('tr');     
		        
		        bootbox.confirm("Deseja realmente excluir o registro?", function(result){
		            if(result){
		                
		                $.ajax({
		                    url: url_destroy,
		                    type: 'GET',
		                    beforeSend: function() {
		                        dialogDelete = bootbox.dialog({
		                            title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
		                            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
		                            closeButton: true
		                        });
		                    },
		                    success: function( data ) {
		                        dialogDelete.init(function(){
		                            if (data.status == "success"){
		                                dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
		                                dialogDelete.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
		                                
		                                $.fn.removeItemContratacao(tr);

		                                setTimeout(function(){
		                                    dialogDelete.modal('hide');
		                                }, 3000);
		                            }else{
		                                dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
		                                var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
		                                if (typeof data.detail != "undefined"){
		                                    aviso = aviso + '<ul class="list-unstyled spaced">';    
		                                    aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
		                                    aviso = aviso + '</ul>';    
		                                }
		                                dialogDelete.find('.bootbox-body').html(aviso);
		                            }
		                        });
		                    },
		                    error: function(data) {
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

		                        dialogDelete.init(function(){
		                            dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
		                            dialogDelete.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
		                        }); 
		                    }
		                });
		            }
		        });

		    }); 

			$.fn.removeItemContratacao = function(linha) {
				var qtd = [];
				var valor_geral = 0;
				var j = 0;

			    linha.fadeOut(400, function() {		      
		        	linha.remove();  		    
		        	
		       		fields = $('#formulario').find("#lista-itens >tbody >tr input");
		    		fields.each(function() {
	    				if ($(this).context.id == 'qt_item_contratacao_adicionada[]'){
	    			   		qtd[++j] = $(this).val();
	    			   	}
		    			if ($(this).context.id == 'vl_item_contratacao_adicionada[]'){
		    		   		valor_unit = parseInt($(this).val().replace(/[\D]+/g,''));
		    		   		valor_geral += (valor_unit * parseInt(qtd[j].replace(/[\D]+/g,'')));	
		    		   	}
		    		});			
		    		$('#vlr_geral').html($.fn.formataValorReal(valor_geral));	
		    		$('#vl_mensal').val($.fn.formataValorReal(valor_geral));
		        });		
			}

			$.fn.setValorVazioItemContratacao = function() {
				$('#id_unidade_atendida').val("");
				$('#ds_unidade_atendida').val("");
				$('#id_edificio_atendido').val("");
				$('#ds_edificio_atendido').val("");
				$('#id_tipo_item').val("");
				$('#ds_tipo_item').val("");
				$('#qt_item_contratacao').val("");
				$('#vl_item_contratacao').val("");
			}

			$('#ds_informacao_complementar').inputlimiter({
				remText: '%n caractere%s remanescente...',
				limitText: 'máximo permitido: %n.'
			});

			
			/*******************************************************************************************************************************
			FUNCIONALIDADES REFERENTE AOS MODAIS DE ORGAO E EDIFICIO
			*******************************************************************************************************************************/
			$(document).on('click', '#bt_buscar_orgao', function(){  
				$('#modal-create').modal('show');
				$('#modal-create').on('shown.bs.modal', function () {
					$.fn.chosen_select();
				});
			});

			$(document).on('change', '.select-orgao', function(){  
				$(".select-orgao option:selected").each(function() {
			    	$('#ds_unidade_atendida').val($(this).text());
			    });
				$('#id_unidade_atendida').val($(this).val());
				$(this).val('');
				$('#modal-create').modal('hide');
			});

			$(document).on('click', '#bt_buscar_edificio', function(){  
				$('#modal-create-edificio').modal('show');
			});

			$(document).on('change', '.select-uf', function(){  
				
				var v_uf  = $(this).val();
				var v_url = "{{ url('gescon/edificios/recuperar-dados-bd/') }}";
				
			    $.ajax({
			        url: v_url + "/" + v_uf,
			        type: 'GET',
			        dataType: 'json',
			        contentType: false, 
			        processData: false,
			        
			        beforeSend: function() {
			        	$(".loading_spinner_edificio").show();
			            $('#id_edificio').empty();
			        },
			        success: function(data) {
			            $("#id_edificio").append('<option value="">SELECIONE...</option>');
			            $.each(data, function(i, item) {
			                $("#id_edificio").append('<option value="' + i + '">' + item + '</option>');
			            });
			            $(".loading_spinner_edificio").hide();
			        },
			        error: function(){
			            $(".loading_spinner_edificio").hide();
			        }
			    });

			});

			$(document).on('change', '.select-edificio', function(){  
				if ($(this).val() != ""){
					$(".select-edificio option:selected").each(function() {
				    	$('#ds_edificio_atendido').val($(this).text());
				    });
					$('#id_edificio_atendido').val($(this).val());
					$(this).val('');
					$('#modal-create-edificio').modal('hide');	
				}
			});

			$(document).on('click', '#bt_buscar_tipo_item', function(){  
				$('#modal-create-tipo-item').modal('show');
				$('#modal-create-tipo-item').on('shown.bs.modal', function () {
					$.fn.chosen_select();
				});
			});

			$(document).on('change', '.select-tipo-item', function(){  
				$(".select-tipo-item option:selected").each(function() {
			    	$('#ds_tipo_item').val($(this).text());
			    });
				$('#id_tipo_item').val($(this).val());
				$(this).val('');
				$('#modal-create-tipo-item').modal('hide');
			});

        });  
    </script>
@endsection