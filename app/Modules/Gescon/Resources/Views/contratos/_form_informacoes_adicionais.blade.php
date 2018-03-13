<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="row header smaller lighter grey">
    		<span class="col-sm-12">
    			Informações Adicionais
    		</span>	
        </h5>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('id_informacao', 'Campo:') !!}
           	{!! Form::text('id_informacao', null, ['class' => 'form-control', 'id' => 'id_informacao']) !!}
        </div>
    </div>
    <div class="col-lg-8">
        <div class="form-group">
            {!! Form::label('ds_informacao', 'Descrição:') !!}
            {!! Form::text('ds_informacao', null, ['class' => 'form-control', 'id' => 'ds_informacao']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        {!! Form::button('<i class="fa fa-plus"></i> Informações', ['class'=>'btn btn-sm btn-primary pull-right', 'id' => 'adiciona-informacao']) !!}
    </div>
</div>
<br>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="widget-box widget-color-grey" id="div-informacao">
			<div class="widget-header widget-header-small">
			    <h5 class="widget-title smaller">Informações Adicionadas</h5>
			</div>
		    <div class="widget-body">
		        <div class="widget-main no-padding">
		        	<table class="table table-striped table-bordered table-hover" id="lista-informacao">
		        		<tbody>
		        			<tr>
				            	<th style="text-align:center">Campo</th>
		        				<th style="text-align:center">Descrição</th>
		        				<th style="text-align:center">Ação</th>
		        			</tr>

                            @if (isset($contrato))

                                @foreach ($contrato->outrasInformacoes as $outraInformacao)

                                    <tr>
                                    <td width="30%">
                                        <input id="st_informacao_novo[]" name="st_informacao_novo[]" type="hidden" value="N">
                                        <input id="id_informacao_adicionada[]" name="id_informacao_adicionada[]" type="hidden" value="{{ $outraInformacao->id_campo_informacao_adicional }}">{{ $outraInformacao->id_campo_informacao_adicional }}
                                    </td>
                                    <td width="60%">
                                        <input id="ds_informacao_adicionada[]" name="ds_informacao_adicionada[]" type="hidden" value="{{ $outraInformacao->ds_campo_informacao_adicional }}">{{ $outraInformacao->ds_campo_informacao_adicional }}
                                    </td>
                                    <td width="10%" style="text-align:center">
                                        <a href='#' data-id='{{ $outraInformacao->id_contrato_informacao_adicional }}' data-url="{{ url('gescon/contratos/informacao-adicional/destroy/'). '/' .$outraInformacao->id_contrato_informacao_adicional }}" data-rel="tooltip" data-original-title="Excluir Informação Adicional" class='btn btn-xs btn-danger btn-remove-informacao-ajax'>
                                            <i class='ace-icon fa fa-trash-o'></i>
                                        </a>
                                    </td>

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
        $(document).ready(function(){      

            $('#adiciona-informacao').click(function(){  
                var id_informacao = $('#id_informacao').val();
                var ds_informacao = $('#ds_informacao').val();

                if ($.fn.validacaoCamposOutrasInformacoes()){
    				var newRow = $("<tr>");         
                    var cols = "";      
                    cols += '<td width="30%">';
                    cols += '<input id="st_informacao_novo[]" name="st_informacao_novo[]" type="hidden" value="S">';
                    cols += '<input id="id_informacao_adicionada[]" name="id_informacao_adicionada[]" type="hidden" value="'+ id_informacao +'">'+ id_informacao;
                    cols += '</td>';
                    cols += '<td width="60%">';
                    cols += '<input id="ds_informacao_adicionada[]" name="ds_informacao_adicionada[]" type="hidden" value="'+ ds_informacao +'">'+ ds_informacao;
                    cols += '</td>';
                    cols += '<td width="10%" style="text-align:center">';
                    cols += '<button type="button" data-rel="tooltip" data-original-title="Excluir Informação Adicional" class="btn btn-xs btn-danger btn-remove-informacao pull-center"><i class="ace-icon fa fa-trash-o"/></button>';
                    cols += '</td>';
                    newRow.append(cols);
                    $("#lista-informacao").append(newRow);

                    $.fn.setValorVazioInformacaoAdicional();
                }else{
                    $('#alert-step').show();
                }
            })

            $(document).on('click', '.btn-remove-informacao', function(){  
                var tr = $(this).closest('tr');     
                bootbox.confirm("Deseja realmente excluir o registro?", function(result){
                    if (result){
                        $.fn.removeInformacaoAdicional(tr);    
                    }
                });
            }); 

            $(document).on('click', '.btn-remove-informacao-ajax', function(){  
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
                                        
                                        $.fn.removeInformacaoAdicional(tr);

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

            $.fn.removeInformacaoAdicional = function(linha) {
                linha.fadeOut(400, function() {           
                    linha.remove();             
                });     
            }

			$.fn.setValorVazioInformacaoAdicional = function() {
				$('#id_informacao').val("");
				$('#ds_informacao').val("");
			}
        });  
    </script>
@endsection