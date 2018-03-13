@include('gescon::contratadas._form')

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="row header smaller lighter grey">
            <span class="col-sm-12">
                Preposto
            </span>
        </h5>
    </div>
</div>

<div class="row row_preposto">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('no_preposto', 'Nome:') !!}
            {!! Form::text('no_preposto', null, ['class' => 'form-control', 'id' => 'no_preposto']) !!}
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('nr_telefone_preposto', 'Telefone:') !!}
            {!! Form::text('nr_telefone_preposto', null, ['class'=>'form-control input-mask-telefone-ddd', 'id' => 'nr_telefone_preposto']) !!}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('ds_email_preposto', 'Email:') !!}
            {!! Form::email('ds_email_preposto', null, ['class'=>'form-control', 'id' => 'ds_email_preposto']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">
		{!! Form::button('<i class="fa fa-plus"></i> Preposto', ['class'=>'btn btn-sm btn-primary pull-right', 'data-rel' => 'tooltip', 'data-original-title' => 'Incluir Novo Preposto', 'id' => 'adiciona-preposto', 'name' => 'adiciona-preposto']) !!}
    </div>
</div>	
<br>

<div class="row">
    <div class="col-xs-12 col-sm-12">
    		<div class="widget-box widget-color-grey" id="div-prepostos">
        
            <div class="widget-header widget-header-small">
                <h5 class="widget-title smaller">Prepostos Adicionados</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover" id="lista-prepostos">
                        <tbody>
                            <tr>
                                <th style="text-align:center">Nome</th>
                                <th style="text-align:center">Telefone</th>
                                <th style="text-align:center">Email</th>
                                <th style="text-align:center">Ação</th>
                            </tr>

                            @if (isset($contrato))

                            	@foreach ($contrato->prepostos as $preposto)

                            		<tr>
		                            	<td width="45%">
		                            		<input id="st_preposto_novo[]" name="st_preposto_novo[]" type="hidden" value="N">
		                            		<input id="no_preposto_selecionada[]" name="no_preposto_selecionada[]" type="hidden" value="{{ $preposto->no_preposto }}">{{ $preposto->no_preposto }}
	                            		</td>
		                            	<td width="15%">
		                            		<input id="nr_telefone_preposto_selecionada[]" name="nr_telefone_preposto_selecionada[]" type="hidden" value="{{ $preposto->nr_telefone_preposto }}">{{ $preposto->nr_telefone_preposto }}
	                            		</td>
		                            	<td width="30%">
		                            		<input id="ds_email_preposto_selecionada[]" name="ds_email_preposto_selecionada[]" type="hidden" value="{{ $preposto->ds_email_preposto }}">{{ $preposto->ds_email_preposto }}
	                            		</td>
	                            		<td width="10%" style="text-align:center">
	                            			<a href='#' data-id='{{ $preposto->id_contrato_preposto }}' data-url="{{ url('gescon/contratos/preposto/destroy/'). '/' .$preposto->id_contrato_preposto }}" data-rel="tooltip" data-original-title="Excluir Preposto" class='btn btn-xs btn-danger btn-remove-preposto-ajax'>
	                            			    <i class='ace-icon fa fa-trash-o'></i>
	                            			</a>
	                            		</td>
	                            	</tr>

                            	@endforeach

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-end')
    
    @parent

    <script type="text/javascript">

	    /********************************************************************************************************
        Funções específicadas do step referente a CONTRATADA
        *********************************************************************************************************/
	    $(document).on('click','#bt_buscar_contratada', function() {
	    	var v_campo = $('#nr_cpf_cnpj');
	    	var v_url = "{{ url('gescon/contratadas/recuperar-dados-bd/') }}";
	    	$.fn.busca_Contratada(v_campo, v_url, function(retorno){
	    	    if (retorno != ""){
	    	    	(retorno.id_contratada) ? $('#id_contratada').val(retorno.id_contratada) : $('#id_contratada').val("");
	    	        $('#no_razao_social').val(retorno.no_razao_social);
	        	    $('#ed_logradouro').val(retorno.ed_logradouro); 
	        	    $('#ed_numero_logradouro').val(retorno.ed_numero_logradouro); 
	        	    $('#ed_complemento_logradouro').val(retorno.ed_complemento_logradouro); 
	        	    $('#ed_bairro_logradouro').val(retorno.ed_bairro_logradouro); 
	        	    $('#ed_cep_logradouro').val(retorno.ed_cep_logradouro); 
	        	    $('#id_uf_logradouro').val(retorno.id_uf_logradouro); 

	        	    $('#id_municipio_logradouro').empty();
	        	    $.each(retorno.lista_municipios, function(i, item) {
	        	        $("#id_municipio_logradouro").append('<option value="' + item.id_municipio + '">' + item.no_municipio + '</option>');
	        	    });
	    	   	    $("#id_municipio_logradouro").find('option[value=' + retorno.id_municipio_logradouro + ']').attr('selected', 'selected');  

	    	   	    (retorno.no_representante) ? $('#no_representante').val(retorno.no_representante) : $('#no_representante').val("");
	    	   	    (retorno.nr_telefone) ? $('#nr_telefone').val(retorno.nr_telefone) : $('#nr_telefone').val("");
	    	   	    (retorno.ds_email) ? $('#ds_email').val(retorno.ds_email) : $('#ds_email').val("");

	    	   	    $.fn.setDisableContratada(true, retorno);  
	    	    }else{
	    	   	    $('#no_razao_social').val('');
	    	        $('#ed_logradouro').val('');
	    	        $('#ed_numero_logradouro').val('');
	    	        $('#ed_complemento_logradouro').val('');
	    	        $('#ed_bairro_logradouro').val('');
	    	        $('#ed_cep_logradouro').val('');
	    	        $('#id_uf_logradouro').val('');
					$('#no_representante').val('');
					$('#nr_telefone').val('');
					$('#ds_email').val('');	    	        
	    	        $.fn.setDisableContratada(false, retorno); 
	    	    }
	    	    dialogCreate.modal('hide');
	    	});
	    });

	    $(document).on('click','#bt_buscar_cep', function() {
	    	$.fn.busca_Campo_CEP("{{ url('portal/municipios/lista/') }}");
	    });

	    $("#id_uf_logradouro").change(function() {
	    	$.fn.busca_Municipios_UF("{{ url('portal/municipios/lista/') }}");
	    });

	    $.fn.setDisableContratada = function(state, data) {
	    	$("#no_razao_social").prop("readonly", state);
	    	$("#ed_logradouro").prop("readonly", state);
	    	$("#ed_numero_logradouro").prop("readonly", state);	    
	    	$("#ed_complemento_logradouro").prop("readonly", state);	    
	    	$("#ed_bairro_logradouro").prop("readonly", state);	    
	    	$("#ed_cep_logradouro").prop("readonly", state);	    
	    	$("#bt_buscar_cep").prop("readonly", state);	    
	    	$("#id_uf_logradouro").prop("readonly", state);	    
	    	$("#id_municipio_logradouro").prop("readonly", state);	    
	    	if (data.id_contratada){
	    		$('#no_representante').prop("readonly", state);	    
	    		$('#nr_telefone').prop("readonly", state);	    
	    		$('#ds_email').prop("readonly", state);	    	
	    	}else{
	    		$('#no_representante').prop("readonly", false);	    
	    		$('#nr_telefone').prop("readonly", false);	    
	    		$('#ds_email').prop("readonly", false);	    	
	    	}
	    }

	    $('#adiciona-preposto').click(function(){  
	        var no_preposto = $('#no_preposto').val();
	        var nr_telefone_preposto = $('#nr_telefone_preposto').val();
	        var ds_email_preposto = $('#ds_email_preposto').val();
	        
	        if ($.fn.validacaoCamposPreposto()){
	            var newRow = $("<tr>");         
	            var cols = "";      
	            cols += '<td width="45%">';
	            cols += '<input id="st_preposto_novo[]" name="st_preposto_novo[]" type="hidden" value="S">';
	            cols += '<input id="no_preposto_selecionada[]" name="no_preposto_selecionada[]" type="hidden" value="'+ no_preposto +'">'+ no_preposto;
	            cols += '</td>';
	            cols += '<td width="15%">';
	            cols += '<input id="nr_telefone_preposto_selecionada[]" name="nr_telefone_preposto_selecionada[]" type="hidden" value="'+ nr_telefone_preposto +'">'+ nr_telefone_preposto;
	            cols += '</td>';
	            cols += '<td width="30%">';
	            cols += '<input id="ds_email_preposto_selecionada[]" name="ds_email_preposto_selecionada[]" type="hidden" value="'+ ds_email_preposto +'">'+ ds_email_preposto;
	            cols += '</td>';
	            cols += '<td width="10%" style="text-align:center">';
	            cols += '<button type="button" class="btn btn-xs btn-danger btn-remove-preposto" data-rel="tooltip" data-original-title="Excluir Preposto"><i class="ace-icon fa fa-trash-o"/></button>';
	            cols += '</td>';
	            newRow.append(cols);
	            $("#lista-prepostos").append(newRow);

	            $.fn.setValorVazioPreposto();    
	        }else{
	            $('#alert-step').show();
	        }
	    })

	    $(document).on('click', '.btn-remove-preposto', function(){  
	        var tr = $(this).closest('tr');     
	        bootbox.confirm("Deseja realmente excluir o registro?", function(result){
		        if (result){
		        	$.fn.removePreposto(tr);	
		        }
		    });
	    }); 

		$(document).on('click', '.btn-remove-preposto-ajax', function(){  
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
	                                
	                                $.fn.removePreposto(tr);

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

		$.fn.removePreposto = function(linha) {
			linha.fadeOut(400, function() {		      
	        	linha.remove();  		    
	        });		
		}
	    
	    $.fn.setValorVazioPreposto = function() {
    	    $('#no_preposto').val("");
    	    $('#nr_telefone_preposto').val("");
    	    $('#ds_email_preposto').val("");
    	}

    </script>   

@endsection