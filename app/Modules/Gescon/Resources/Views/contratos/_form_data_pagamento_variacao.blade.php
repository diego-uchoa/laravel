<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="header smaller lighter grey">Datas</h5>
    </div>
</div>
<div class="row">
	<div class="col-xs-2 col-sm-2">
        <div class="form-group">
			{!! Form::label('dt_assinatura', 'Assinatura:') !!}
            <div class="input-group">
                {!! Form::text('dt_assinatura', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_assinatura']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
		</div>
	</div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('dt_publicacao', 'Publicação do Contrato:') !!}
            <div class="input-group">
                {!! Form::text('dt_publicacao', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_publicacao']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('dt_inicio_servico', 'Início Prest. de Serviço:') !!}
            <div class="input-group">
                {!! Form::text('dt_inicio_servico', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_inicio_servico']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('dt_cessacao', 'Cessação:') !!}
            <div class="input-group">
                {!! Form::text('dt_cessacao', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_cessacao']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('nr_ano_prorrogacao', 'Prorrogável por:') !!}
            {!! Form::select('nr_ano_prorrogacao', [ '' => 'Selecione...', 1 => '1 ano',  2 => '2 anos',  3 => '3 anos',  4 => '4 anos',  5 => '5 anos', ], null, ['data-placeholder' => 'Selecione ...', 'class'=>'form-control', 'id' => 'nr_ano_prorrogacao']) !!}
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('dt_prorrogacao', 'Prorrogável até:') !!}
            {!! Form::text('dt_prorrogacao', null, ['class'=>'form-control', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_prorrogacao', 'readonly']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="header smaller lighter grey">Variação</h5>
    </div>
</div>
<div class="row">
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('in_tipo_variacao', 'Variação:') !!}
            {!! Form::select('in_tipo_variacao', $listaTipoVariacao, null, ['data-placeholder' => 'Selecione ...', 'class'=>'form-control', 'id' => 'in_tipo_variacao']) !!}
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('id_indice_variacao', 'Índice de Variação:') !!}
            {!! Form::select('id_indice_variacao', $listaIndiceVariacao, null, ['data-placeholder' => 'Selecione ...', 'class'=>'form-control', 'id' => 'id_indice_variacao']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="row header smaller lighter grey">
            <span class="col-sm-12">
                Processos de Pagamento
            </span>
        </h5>
    </div>
</div>

<div class="row row_processo">
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('nr_nota_empenho', 'Nota de Empenho:') !!}
            {!! Form::text('nr_nota_empenho', null, ['class' => 'form-control input-mask-numero-nota_empenho', 'id' => 'nr_nota_empenho']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('tp_nota_empenho', 'Tipo de Empenho:') !!}
            {!! Form::select('tp_nota_empenho', $listaTipoEmpenho, null, ['data-placeholder' => 'Selecione ...', 'class'=>'form-control', 'id' => 'tp_nota_empenho']) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('nr_plano_interno', 'Plano Interno:') !!}
            {!! Form::text('nr_plano_interno', null, ['class' => 'form-control', 'id' => 'nr_plano_interno', 'maxlength' => 20]) !!}
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('nr_elemento_despesa', 'Elemento de Despesa:') !!}
            {!! Form::text('nr_elemento_despesa', null, ['class' => 'form-control input-mask-numero-elemento_despesa', 'id' => 'nr_elemento_despesa']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        {!! Form::button('<i class="fa fa-plus"></i> Processo', ['class'=>'btn btn-sm btn-primary pull-right', 'data-rel' => 'tooltip', 'data-original-title' => 'Incluir Novo Processo de Pagamento', 'id' => 'adiciona-processo', 'name' => 'adiciona-processo']) !!}
    </div>
</div>
<br>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box widget-color-grey" id="div-processos">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title smaller">Processos de Pagamento Adicionados</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover" id="lista-processos">
                        <tbody>
                            <tr>
                                <th style="text-align:center">Nota de Empenho</th>
                                <th style="text-align:center">Tipo de Empenho</th>
                                <th style="text-align:center">Plano Interno</th>
                                <th style="text-align:center">Elemento de Despesa</th>
                                <th style="text-align:center">Ação</th>
                            </tr>

                            @if (isset($contrato))

                                @foreach ($contrato->processosPagamento as $processoPagamento)

                                    <tr>
                                        <td width="22%">
                                            <input id="st_processo_pagamanento_novo[]" name="st_processo_pagamanento_novo[]" type="hidden" value="N">
                                            <input id="nr_nota_empenho_selecionada[]" name="nr_nota_empenho_selecionada[]" type="hidden" value="{{ $processoPagamento->nr_nota_empenho }}">{{ $processoPagamento->nr_nota_empenho }}
                                        </td>
                                        <td width="22%">
                                            <input id="tp_nota_empenho_selecionada[]" name="tp_nota_empenho_selecionada[]" type="hidden" value="{{ $processoPagamento->tipoEmpenho() }}">{{ $processoPagamento->tipoEmpenho() ?? ' - ' }}
                                        </td>
                                        <td width="22%">
                                            <input id="nr_plano_interno_selecionada[]" name="nr_plano_interno_selecionada[]" type="hidden" value="{{ $processoPagamento->nr_plano_interno }}">{{ $processoPagamento->nr_plano_interno ?? ' - ' }}
                                        </td>
                                        <td width="22%">
                                            <input id="nr_elemento_despesa_selecionada[]" name="nr_elemento_despesa_selecionada[]" type="hidden" value="{{ $processoPagamento->nr_elemento_despesa }}">{{ $processoPagamento->nr_elemento_despesa ?? ' - ' }}
                                        </td>
                                        <td width="12%" style="text-align:center">
                                            <a href='#' data-id='{{ $processoPagamento->id_contrato_processo_pagamento }}' data-url="{{ url('gescon/contratos/processo-pagamento/destroy/'). '/' .$processoPagamento->id_contrato_processo_pagamento }}" data-rel="tooltip" data-original-title="Excluir Processo Pagamento" class='btn btn-xs btn-danger btn-remove-pagamento-ajax'>
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
            Funções específicadas do step referente a DATAS/PAGAMENTOS/VARIAÇÃO
            *********************************************************************************************************/
            $('#adiciona-processo').click(function(){  
                var nr_nota_empenho = $('#nr_nota_empenho').val();
                
                if ($('#tp_nota_empenho').val() == ''){
                    var id_tp_nota_empenho = '';
                    var ds_tp_nota_empenho = ' - ';                    
                }else{
                    var id_tp_nota_empenho = $('#tp_nota_empenho').val();
                    var ds_tp_nota_empenho = $('#tp_nota_empenho option:selected').text();                
                }

                if ($('#tp_nota_empenho').val() == ''){
                    var nr_plano_interno_valor = '';
                    var nr_plano_interno_texto = ' - ';
                }else{
                    var nr_plano_interno_valor = $('#nr_plano_interno').val();
                    var nr_plano_interno_texto = $('#nr_plano_interno').val();
                }                
                
                if ($('#nr_elemento_despesa').val().replace(/[^\d]+/g,'') == ''){
                    var nr_elemento_despesa_valor = '';
                    var nr_elemento_despesa_texto = ' - ';
                }else{
                    var nr_elemento_despesa_valor = $('#nr_elemento_despesa').val();
                    var nr_elemento_despesa_texto = $('#nr_elemento_despesa').val();
                } 
                
                if ($.fn.validacaoCamposProcessosPagamento()){
                    var newRow = $("<tr>");         
                    var cols = "";      
                    cols += '<td width="22%">';
                    cols += '<input id="st_processo_pagamanento_novo[]" name="st_processo_pagamanento_novo[]" type="hidden" value="S">';
                    cols += '<input id="nr_nota_empenho_selecionada[]" name="nr_nota_empenho_selecionada[]" type="hidden" value="'+ nr_nota_empenho +'">'+ nr_nota_empenho;
                    cols += '</td>';
                    cols += '<td width="22%">';
                    cols += '<input id="tp_nota_empenho_selecionada[]" name="tp_nota_empenho_selecionada[]" type="hidden" value="'+ id_tp_nota_empenho +'">'+ ds_tp_nota_empenho;
                    cols += '</td>';
                    cols += '<td width="22%">';
                    cols += '<input id="nr_plano_interno_selecionada[]" name="nr_plano_interno_selecionada[]" type="hidden" value="'+ nr_plano_interno_valor +'">'+ nr_plano_interno_texto;
                    cols += '</td>';
                    cols += '<td width="22%">';
                    cols += '<input id="nr_elemento_despesa_selecionada[]" name="nr_elemento_despesa_selecionada[]" type="hidden" value="'+ nr_elemento_despesa_valor +'">'+ nr_elemento_despesa_texto;
                    cols += '</td>';
                    cols += '<td width="12%" style="text-align:center">';
                    cols += '<button type="button" data-rel="tooltip" data-original-title="Excluir Processo Pagamento" class="btn btn-xs btn-danger btn-remove-pagamento"><i class="ace-icon fa fa-trash-o"/></button>';
                    cols += '</td>';
                    newRow.append(cols);
                    $("#lista-processos").append(newRow);

                    $.fn.setValorVazioProcessoPagamento();    
                }else{
                    $('#alert-step').show();
                }
            })

            $(document).on('click', '.btn-remove-pagamento', function(){  
                var tr = $(this).closest('tr');     
                bootbox.confirm("Deseja realmente excluir o registro?", function(result){
                    if (result){
                        $.fn.removePagmanento(tr);
                    }
                });
            }); 

            $(document).on('click', '.btn-remove-pagamento-ajax', function(){  
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
                                        
                                        $.fn.removePagmanento(tr);

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

            $.fn.removePagmanento = function(linha) {
                linha.fadeOut(400, function() {           
                    linha.remove();             
                });     
            }

            $.fn.setValorVazioProcessoPagamento = function() {
                $('#nr_nota_empenho').val("");
                $('#tp_nota_empenho').val("");
                $('#nr_plano_interno').val("");
                $('#nr_elemento_despesa').val("");
            }

            $('#nr_ano_prorrogacao').change(function(){
                data = $('#dt_assinatura').val(); 
                if (data != ""){
                    dd = data.substring(0, 2);
                    mm = data.substring(3, 5);
                    yyy = data.substring(6, 10); 
                    dataingles = mm + "/" + dd + "/" + yyy ; 
                    $('#dt_prorrogacao').val($.fn.setAnoDataProrrogacao(new Date(dataingles), this.value));    
                }else{
                    $('#dt_prorrogacao').val('');
                }
            })

            $.fn.setAnoDataProrrogacao = function(oldDate, offset){
                if (offset != ""){
                    var qtd = parseInt(offset);
                    var year = parseInt(oldDate.getFullYear());
                    var month = parseInt(oldDate.getMonth());
                    var date = parseInt(oldDate.getDate());
                    var newDate = new Date(year + qtd, month, date);

                    var dia = newDate.getDate()
                    var mes = newDate.getMonth() + 1;
                    var ano = newDate.getFullYear();

                    if (dia < 10) dia = '0' + dia;
                    if (mes < 10) mes = '0' + mes;
                    
                    return dia + "/" + mes + "/" + ano;    
                }
            }

            
    </script>
@endsection
