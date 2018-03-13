<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="header smaller lighter grey">Garantia</h5>
    </div>
</div>
<div class="row">
	<div class="col-xs-2 col-sm-2">
        <div class="form-group">
			{!! Form::label('in_modalidade_garantia', 'Modalidade:') !!}
            {!! Form::select('in_modalidade_garantia', $listaModalidadeGarantia, null, ['class'=>'form-control', 'id' => 'in_modalidade_garantia']) !!}
		</div>
	</div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('vl_garantia', 'Valor:') !!}
            {!! Form::text('vl_garantia', null, ['class' => 'form-control input-mask-money', 'id' => 'vl_garantia']) !!}
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('op_percentual_garantia', 'Percentual:') !!}
            {!! Form::text('op_percentual_garantia', null, ['class' => 'form-control input-mask-money', 'id' => 'op_percentual_garantia']) !!}
        </div>
    </div>
    <div class="col-xs-2 col-sm-2">
        <div class="form-group">
            {!! Form::label('dt_vencimento_garantia', 'Vencimento:') !!}
            <div class="input-group">
                {!! Form::text('dt_vencimento_garantia', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_vencimento_garantia']) !!}
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <h5 class="row header smaller lighter grey">
            <span class="col-sm-12">
                Fiscais
            </span>
        </h5>
    </div>
</div>

<div class="row row_fiscal">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-lg-3">
                <div class="form-group">
                    {!! Form::label('in_tipo_fiscal', 'Tipo Fiscal:') !!}
                    {!! Form::select('in_tipo_fiscal', $listaTipoFiscal, null, ['data-placeholder' => 'Selecione ...', 'class'=>'form-control', 'id' => 'in_tipo_fiscal']) !!}
                </div>    
            </div>
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_portaria', 'Nº Portaria:') !!}
                    {!! Form::text('nr_portaria', null, ['class'=>'form-control input-mask-numero-portaria', 'id' => 'nr_portaria']) !!}
                </div>    
            </div>
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('dt_inicio_fiscal', 'Início da Execução:') !!}
                    <div class="input-group">
                        {!! Form::text('dt_inicio_fiscal', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_inicio_fiscal']) !!}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                        </span>
                    </div>
                </div>    
            </div>
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_boletim', 'Nº e-BPS:') !!}
                    {!! Form::text('nr_boletim', null, ['class'=>'form-control input-mask-numero-boletim', 'id' => 'nr_boletim']) !!}
                </div>    
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3">
                <div class="form-group">
                    {!! Form::label('arquivo-ebps', 'Anexar Arquivo e-BPS:') !!}
                    {!! Form::file('arquivo-ebps',['class'=>'form-control input-large', 'id'=>'arquivo-ebps']) !!}  
                </div>
            </div>      
        </div>    
        <br>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-lg-6">
                <div class="col-xs-12 label label-lg label-info arrowed-right">
                    <b>Titular</b>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6">
                <div class="col-xs-12 label label-lg label-success arrowed">
                    <b>Substituto</b>
                </div>
            </div>
        </div>        
        <br>
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_cpf_titular', 'CPF:') !!}
                    {!! Form::hidden('id_titular', null, ['id' => 'id_titular']) !!}
                    <div class="input-group">
                        {!! Form::text('nr_cpf_titular', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf_titular']) !!}
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button" data-rel="tooltip" data-original-title="Buscar Fiscal Titular" id="bt_buscar_fiscal_titular" name="bt_buscar_fiscal_titular">
                                <i class="fa fa-search bigger-110"></i>
                            </button>
                        </span>
                    </div>
                </div>    
            </div>    
            <div class="col-xs-4 col-sm-4 col-lg-4">
                <div class="form-group">
                    {!! Form::label('no_titular', 'Nome:') !!}
                    {!! Form::text('no_titular', null, ['class'=>'form-control', 'id' => 'no_titular', 'readonly']) !!}
                </div>
            </div>        
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_cpf_substituto', 'CPF:') !!}
                    {!! Form::hidden('id_substituto', null, ['id' => 'id_substituto']) !!}
                    <div class="input-group">
                        {!! Form::text('nr_cpf_substituto', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf_substituto']) !!}
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button" data-rel="tooltip" data-original-title="Buscar Fiscal Substituto" id="bt_buscar_fiscal_substituto" name="bt_buscar_fiscal_substituto">
                                <i class="fa fa-search bigger-110"></i>
                            </button>
                        </span>
                    </div>
                </div>    
            </div>    
            <div class="col-xs-4 col-sm-4 col-lg-4">
                <div class="form-group">
                    {!! Form::label('no_substituto', 'Nome:') !!}
                    {!! Form::text('no_substituto', null, ['class'=>'form-control', 'id' => 'no_substituto', 'readonly']) !!}
                </div>
            </div>        
        </div>
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_matricula_titular', 'Matrícula SIAPE:') !!}
                    {!! Form::text('nr_matricula_titular', null, ['class'=>'form-control input-mask-numero-matricula-siape', 'id' => 'nr_matricula_titular', 'readonly']) !!}
                </div>    
            </div>    
            <div class="col-xs-4 col-sm-4 col-lg-4">
                <div class="form-group">
                    {!! Form::label('ds_email_titular', 'Email:') !!}
                    {!! Form::text('ds_email_titular', null, ['class'=>'form-control', 'id' => 'ds_email_titular', 'readonly', 'maxlength' => 100]) !!}
                </div>
            </div>        
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_matricula_substituto', 'Matrícula SIAPE:') !!}
                    {!! Form::text('nr_matricula_substituto', null, ['class'=>'form-control input-mask-numero-matricula-siape', 'id' => 'nr_matricula_substituto', 'readonly']) !!}
                </div>    
            </div>    
            <div class="col-xs-4 col-sm-4 col-lg-4">
                <div class="form-group">
                    {!! Form::label('ds_email_substituto', 'Email:') !!}
                    {!! Form::text('ds_email_substituto', null, ['class'=>'form-control', 'id' => 'ds_email_substituto', 'readonly', 'maxlength' => 100]) !!}
                </div>
            </div>        
        </div>
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_telefone_titular', 'Telefone:') !!}
                    {!! Form::text('nr_telefone_titular', null, ['class'=>'form-control input-mask-telefone-ddd', 'id' => 'nr_telefone_titular', 'readonly']) !!}
                </div>    
            </div>
            <div class="col-xs-4 col-sm-4 col-lg-4"></div>
            <div class="col-xs-2 col-sm-2 col-lg-2">
                <div class="form-group">
                    {!! Form::label('nr_telefone_substituto', 'Telefone:') !!}
                    {!! Form::text('nr_telefone_substituto', null, ['class'=>'form-control input-mask-telefone-ddd', 'id' => 'nr_telefone_substituto', 'readonly']) !!}
                </div>    
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                {!! Form::button('<i class="fa fa-plus"></i> Fiscal', ['class'=>'btn btn-sm btn-primary pull-right', 'data-rel' => 'tooltip', 'data-original-title' => 'Incluir Novo Fiscal', 'id' => 'adiciona-fiscal', 'name' => 'adiciona-fiscal']) !!}
            </div>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box widget-color-grey" id="div-fiscais">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title smaller">Fiscais Adicionados</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover" id="lista-fiscais">
                        <tbody>
                            <tr>
                                <th style="text-align:center">Tipo Fiscal</th>
                                <th style="text-align:center">Titular</th>
                                <th style="text-align:center">Substituto</th>
                                <th style="text-align:center">Arq. e-BPS</th>
                                <th style="text-align:center">Nº da Portaria</th>
                                <th style="text-align:center">Ação</th>
                            </tr>

                            @if (isset($contrato))

                                @foreach ($contrato->fiscais as $fiscal)

                                    <tr>
                                    <td width="20%">
                                        <input id="st_fiscal_novo[]" name="st_fiscal_novo[]" type="hidden" value="N">
                                        <input id="in_tipo_fiscal_selecionado[]" name="in_tipo_fiscal_selecionado[]" type="hidden" value="{{ $fiscal->in_tipo }}">{{ $fiscal->tipoFiscal() }}
                                    </td>
                                    <td width="25%">
                                        <input id="id_titular_selecionado[]" name="id_titular_selecionado[]" type="hidden" value="{{ $fiscal->id_fiscal_titular }}">
                                        <input id="nr_cpf_titular_selecionado[]" name="nr_cpf_titular_selecionado[]" type="hidden" value="{{ $fiscal->fiscalTitular->nr_cpf }}">
                                        <input id="no_titular_selecionado[]" name="no_titular_selecionado[]" type="hidden" value="{{ $fiscal->fiscalTitular->no_fiscal }}">
                                        <input id="nr_matricula_titular_selecionado[]" name="nr_matricula_titular_selecionado[]" type="hidden" value="{{ $fiscal->fiscalTitular->nr_siape }}">
                                        <input id="ds_email_titular_selecionado[]" name="ds_email_titular_selecionado[]" type="hidden" value="{{ $fiscal->fiscalTitular->ds_email }}">
                                        <input id="nr_telefone_titular_selecionado[]" name="nr_telefone_titular_selecionado[]" type="hidden" value="{{ $fiscal->fiscalTitular->nr_telefone }}">{{ $fiscal->fiscalTitular->no_fiscal }}
                                    </td>
                                    <td width="25%">
                                        <input id="id_substituto_selecionado[]" name="id_substituto_selecionado[]" type="hidden" value="{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->id_fiscal_substituto : '' }}">
                                        <input id="nr_cpf_substituto_selecionado[]" name="nr_cpf_substituto_selecionado[]" type="hidden" value="{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->nr_cpf : '' }}">
                                        <input id="no_substituto_selecionado[]" name="no_substituto_selecionado[]" type="hidden" value="{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->no_fiscal : '' }}">
                                        <input id="nr_matricula_substituto_selecionado[]" name="nr_matricula_substituto_selecionado[]" type="hidden" value="{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->nr_siape : '' }}">
                                        <input id="ds_email_substituto_selecionado[]" name="ds_email_substituto_selecionado[]" type="hidden" value="{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->ds_email : '' }}">
                                        <input id="nr_telefone_substituto_selecionado[]" name="nr_telefone_substituto_selecionado[]" type="hidden" value="{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->nr_telefone : '' }}">{{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->no_fiscal : ' - ' }}
                                    </td>    
                                    <td width="10%" style="text-align:center">
                                        <input id="arquivo_ebps_selecionado[]" name="arquivo_ebps_selecionado[]" type="hidden" value="{{ isset($fiscal->tx_arquivo_ebps) ? $fiscal->tx_arquivo_ebps : '' }}">
                                        @if ($fiscal->tx_arquivo_ebps)                                         
                                            <a class="btn btn-xs btn-warning" href="/uploads/gescon/{{ $fiscal->tx_arquivo_ebps }}"><i class="ace-icon fa fa-file"></i></a>';
                                        @else
                                            -   
                                        @endif
                                    </td>
                                    <td width="15%">
                                        <input id="nr_portaria_selecionado[]" name="nr_portaria_selecionado[]" type="hidden" value="{{ $fiscal->nr_portaria }}">
                                        <input id="dt_inicio_fiscal_selecionado[]" name="dt_inicio_fiscal_selecionado[]" type="hidden" value="{{ $fiscal->dt_execucao }}">
                                        <input id="nr_boletim_selecionado[]" name="nr_boletim_selecionado[]" type="hidden" value="{{ $fiscal->nr_boletim }}">{{ $fiscal->nr_portaria }}
                                    </td>
                                    <td width="5%" style="text-align:center">
                                        <a href='#' data-id='{{ $fiscal->id_contrato_fiscal }}' data-url="{{ url('gescon/contratos/fiscal/destroy/'). '/' .$fiscal->id_contrato_fiscal }}" data-rel="tooltip" data-original-title="Excluir Fiscal" class='btn btn-xs btn-danger btn-remove-fiscal-ajax'>
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

            $('#arquivo-ebps').ace_file_input({
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
            $('#arquivo-ebps').on('file.error.ace', function(ev, info) {
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
                $('#arquivo-ebps').ace_file_input('reset_input');
            });

            $.fn.excluir_arquivo_ebps = function() {
                $("#btn-excluir-documento-ebps").click(function(){
                    bootbox.confirm("Deseja realmente excluir o arquivo do e-BPS?", function(result){
                        if(result) {         
                            $('#row-arquivo-ebps').hide();
                            $('#row-arquivo-input-ebps').show();
                            $("input[name='arquivo_ebps_delete']").val('true');
                        }
                    });
                });
            };

            $.fn.envia_arquivo_ebps_temp = function(callback) {
                var url = "{{ url('gescon/contratos/arquivo-ebps/upload-tmp/') }}";
                var form = new FormData();

                //Recuperando o arquivo de upload do Fiscal, se houver
                var file = $('#formulario input[type="file"][name="arquivo-ebps"]')[0].files[0];
                if (file){
                    
                    form.append('arquivo-ebps', file);       
                    form.append('_token', $("input[name='_token']").val());   

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form,
                        dataType: 'json',
                        contentType: false, 
                        processData: false,
                        
                        success: function(data) {
                            callback(data.msg);
                        }
                    });

                }else{
                    
                    callback('');

                }
                
            };


            /********************************************************************************************************
            Funções específicadas do step referente a FISCAL
            *********************************************************************************************************/
            $('#adiciona-fiscal').click(function(){  

                var arquivo_ebps = "";
                $.fn.envia_arquivo_ebps_temp(function(retorno){

                    arquivo_ebps = retorno;

                    var in_tipo_fiscal = $('#in_tipo_fiscal').val();
                    var tx_tipo_fiscal = $("#in_tipo_fiscal :selected").text();
                    var id_titular = $('#id_titular').val();
                    var nr_cpf_titular = $('#nr_cpf_titular').val();
                    var no_titular = $('#no_titular').val();
                    var nr_matricula_titular = $('#nr_matricula_titular').val();
                    var ds_email_titular = $('#ds_email_titular').val();
                    var nr_telefone_titular = $('#nr_telefone_titular').val();
                    var nr_portaria = $('#nr_portaria').val();
                    var dt_inicio_fiscal = $('#dt_inicio_fiscal').val();
                    var nr_boletim = $('#nr_boletim').val();
                    var id_substituto = $('#id_substituto').val();
                    var nr_cpf_substituto = $('#nr_cpf_substituto').val();
                    var no_substituto = $('#no_substituto').val();
                    var nr_matricula_substituto = $('#nr_matricula_substituto').val();
                    var ds_email_substituto = $('#ds_email_substituto').val();
                    var nr_telefone_substituto = $('#nr_telefone_substituto').val();

                    if ($.fn.validacaoCamposFiscais()){
                        
                        var newRow = $("<tr>");         
                        var cols = "";      
                        cols += '<td width="20%">';
                            cols += '<input id="st_fiscal_novo[]" name="st_fiscal_novo[]" type="hidden" value="S">';
                            cols += '<input id="in_tipo_fiscal_selecionado[]" name="in_tipo_fiscal_selecionado[]" type="hidden" value="'+ in_tipo_fiscal +'">'+ tx_tipo_fiscal;
                        cols += '</td>';
                        cols += '<td width="25%">';
                            cols += '<input id="id_titular_selecionado[]" name="id_titular_selecionado[]" type="hidden" value="'+ id_titular +'">';
                            cols += '<input id="nr_cpf_titular_selecionado[]" name="nr_cpf_titular_selecionado[]" type="hidden" value="'+ nr_cpf_titular +'">';
                            cols += '<input id="no_titular_selecionado[]" name="no_titular_selecionado[]" type="hidden" value="'+ no_titular +'">';
                            cols += '<input id="nr_matricula_titular_selecionado[]" name="nr_matricula_titular_selecionado[]" type="hidden" value="'+ nr_matricula_titular +'">';
                            cols += '<input id="ds_email_titular_selecionado[]" name="ds_email_titular_selecionado[]" type="hidden" value="'+ ds_email_titular +'">';
                            cols += '<input id="nr_telefone_titular_selecionado[]" name="nr_telefone_titular_selecionado[]" type="hidden" value="'+ nr_telefone_titular +'">'+ no_titular;
                        cols += '</td>';
                        
                        if (nr_cpf_substituto != ""){
                            cols += '<td width="25%">';
                                cols += '<input id="id_substituto_selecionado[]" name="id_substituto_selecionado[]" type="hidden" value="'+ id_substituto +'">';
                                cols += '<input id="nr_cpf_substituto_selecionado[]" name="nr_cpf_substituto_selecionado[]" type="hidden" value="'+ nr_cpf_substituto +'">';
                                cols += '<input id="no_substituto_selecionado[]" name="no_substituto_selecionado[]" type="hidden" value="'+ no_substituto +'">';
                                cols += '<input id="nr_matricula_substituto_selecionado[]" name="nr_matricula_substituto_selecionado[]" type="hidden" value="'+ nr_matricula_substituto +'">';
                                cols += '<input id="ds_email_substituto_selecionado[]" name="ds_email_substituto_selecionado[]" type="hidden" value="'+ ds_email_substituto +'">';
                                cols += '<input id="nr_telefone_substituto_selecionado[]" name="nr_telefone_substituto_selecionado[]" type="hidden" value="'+ nr_telefone_substituto +'">'+ no_substituto;
                            cols += '</td>';    
                        }else{
                            cols += '<td width="25%">';
                                cols += '<input id="id_substituto_selecionado[]" name="id_substituto_selecionado[]" type="hidden" value="">';
                                cols += '<input id="nr_cpf_substituto_selecionado[]" name="nr_cpf_substituto_selecionado[]" type="hidden" value="">';
                                cols += '<input id="no_substituto_selecionado[]" name="no_substituto_selecionado[]" type="hidden" value="">';
                                cols += '<input id="nr_matricula_substituto_selecionado[]" name="nr_matricula_substituto_selecionado[]" type="hidden" value="">';
                                cols += '<input id="ds_email_substituto_selecionado[]" name="ds_email_substituto_selecionado[]" type="hidden" value="">';
                                cols += '<input id="nr_telefone_substituto_selecionado[]" name="nr_telefone_substituto_selecionado[]" type="hidden" value=""> - ';
                            cols += '</td>';    
                        }
                                            
                        cols += '<td width="10%" style="text-align:center">';
                            if (arquivo_ebps != ""){
                                cols += '<input id="arquivo_ebps_selecionado[]" name="arquivo_ebps_selecionado[]" type="hidden" value="'+ arquivo_ebps +'"><a class="btn btn-xs btn-warning" href="/uploads/gescon/arquivos_tmp/' + arquivo_ebps +'"><i class="ace-icon fa fa-file"></i></a>';    
                            }else{
                                cols += '<input id="arquivo_ebps_selecionado[]" name="arquivo_ebps_selecionado[]" type="hidden" value=""> - ';    
                            }
                        cols += '</td>';

                        cols += '<td width="15%">';
                            cols += '<input id="nr_portaria_selecionado[]" name="nr_portaria_selecionado[]" type="hidden" value="'+ nr_portaria +'">';
                            cols += '<input id="dt_inicio_fiscal_selecionado[]" name="dt_inicio_fiscal_selecionado[]" type="hidden" value="'+ dt_inicio_fiscal +'">';
                            cols += '<input id="nr_boletim_selecionado[]" name="nr_boletim_selecionado[]" type="hidden" value="'+ nr_boletim +'">'+ nr_portaria;
                        cols += '</td>';

                        cols += '<td width="5%" style="text-align:center">';
                            cols += '<button type="button" data-rel="tooltip" data-original-title="Excluir Fiscal" class="btn btn-xs btn-danger btn-remove-fiscal"><i class="ace-icon fa fa-trash-o"/></button>';
                        cols += '</td>';
                        newRow.append(cols);
                        $("#lista-fiscais").append(newRow);

                        if (nr_cpf_substituto != ""){
                            bootbox.confirm({
                                title: "Fiscal",
                                message: "Deseja adicionar outro fiscal substituto para o fiscal titular "+ no_titular +"?",
                                buttons: {
                                    cancel: {
                                        label: '<i class="fa fa-times"></i> Não'
                                    },
                                    confirm: {
                                        label: '<i class="fa fa-check"></i> Sim'
                                    }
                                },
                                callback: function (result) {
                                    if (result){
                                        $.fn.setValorVazioFiscalSubstituto();
                                    }else{
                                        $.fn.setValorVazioFiscal();    
                                    }
                                }
                            });
                        }else{
                            $.fn.setValorVazioFiscal();    
                        }

                    }else{
                        $('#alert-step').show();
                    }

                });

                
            })

            $(document).on('click', '.btn-remove-fiscal', function(){  
                var tr = $(this).closest('tr');     
                bootbox.confirm("Deseja realmente excluir o registro?", function(result){
                    if (result){
                        $.fn.removeFiscal(tr);    
                    }
                });
            }); 

            $(document).on('click', '.btn-remove-fiscal-ajax', function(){  
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
                                        
                                        $.fn.removeFiscal(tr);

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

            $.fn.removeFiscal = function(linha) {
                linha.fadeOut(400, function() {           
                    linha.remove();             
                });     
            }

            $.fn.setValorVazioFiscal = function() {
                $('#in_tipo_fiscal').val("");
                $('#id_titular').val("");
                $('#nr_cpf_titular').val("");
                $('#no_titular').val("");
                $('#nr_matricula_titular').val("");
                $('#ds_email_titular').val("");
                $('#nr_telefone_titular').val("");
                $('#id_substituto').val("");
                $('#nr_cpf_substituto').val("");
                $('#no_substituto').val("");
                $('#nr_matricula_substituto').val("");
                $('#ds_email_substituto').val("");
                $('#nr_telefone_substituto').val("");
                $('#nr_portaria').val("");
                $('#dt_inicio_fiscal').val("");
                $('#nr_boletim').val("");
                $(".remove").trigger('click');
            }

            $.fn.setValorVazioFiscalSubstituto = function() {
                $('#id_substituto').val("");
                $('#nr_cpf_substituto').val("");
                $('#no_substituto').val("");
                $('#nr_matricula_substituto').val("");
                $('#ds_email_substituto').val("");
                $('#nr_telefone_substituto').val("");
                $(".remove").trigger('click');
            }

            /********************************************************************************************************
            Função responsável por recuperar dados do Fiscal Titular e Substituto no BD e caso não existir, 
            no WS SIAPE, através do CPF
            *********************************************************************************************************/
            $(document).on('click','#bt_buscar_fiscal_titular', function() {
                var campo = $('#nr_cpf_titular');
                var v_url = "{{ url('gescon/fiscais/recuperar-dados-bd/') }}";
                $.fn.busca_fiscal_por_cpf(campo, v_url, function(retorno){
                    if (retorno != ""){
                        $('#id_titular').val(retorno.id_fiscal);
                        $('#no_titular').val(retorno.no_fiscal);
                        $('#nr_matricula_titular').val(retorno.nr_siape);
                        $('#ds_email_titular').val(retorno.ds_email);
                        $('#nr_telefone_titular').val(retorno.nr_telefone);
                    }else{
                        $('#id_titular').val('');
                        $('#no_titular').val('');
                        $('#nr_matricula_titular').val('');
                        $('#ds_email_titular').val('');
                        $('#nr_telefone_titular').val('');
                    }
                    if (retorno != ''){
                        $.fn.setDisabledFiscalTitular(true, retorno);    
                    }else{
                        $.fn.setDisabledFiscalTitular(false, retorno);    
                    }
                });
            });

            $.fn.setDisabledFiscalTitular = function(state, data) {
                $("#no_titular").prop("readonly", state);
                $("#nr_matricula_titular").prop("readonly", state);     
                $("#ds_email_titular").prop("readonly", state);
                $("#nr_telefone_titular").prop("readonly", state);     
                if (data != ''){
                    if (data.id_fiscal == ""){
                        $("#ds_email_titular").prop("readonly", false);     
                        $("#nr_telefone_titular").prop("readonly", false);     
                    }
                }
            }

            $(document).on('click','#bt_buscar_fiscal_substituto', function() {
                var campo = $('#nr_cpf_substituto');
                var v_url = "{{ url('gescon/fiscais/recuperar-dados-bd/') }}";
                $.fn.busca_fiscal_por_cpf(campo, v_url, function(retorno){
                    if (retorno != ""){
                        $('#id_substituto').val(retorno.id_fiscal);
                        $('#no_substituto').val(retorno.no_fiscal);
                        $('#nr_matricula_substituto').val(retorno.nr_siape);
                        $('#ds_email_substituto').val(retorno.ds_email);
                        $('#nr_telefone_substituto').val(retorno.nr_telefone);
                    }else{
                        $('#id_substituto').val('');
                        $('#no_substituto').val('');
                        $('#nr_matricula_substituto').val('');
                        $('#ds_email_substituto').val('');
                        $('#nr_telefone_substituto').val('');
                    }
                    if (retorno != ''){
                        $.fn.setDisabledFiscalSubstituto(true, retorno);    
                    }else{
                        $.fn.setDisabledFiscalSubstituto(false, retorno);    
                    }
                });
            });

            $.fn.setDisabledFiscalSubstituto = function(state, data) {
                $("#no_substituto").prop("readonly", state);
                $("#nr_matricula_substituto").prop("readonly", state);     
                $("#ds_email_substituto").prop("readonly", state);
                $("#nr_telefone_substituto").prop("readonly", state);     
                if (data != ''){
                    if (data.id_fiscal == ""){
                        $("#ds_email_substituto").prop("readonly", false);     
                        $("#nr_telefone_substituto").prop("readonly", false);     
                    }
                }
            }

    </script>
@endsection
