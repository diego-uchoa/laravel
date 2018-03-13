$.fn.carregarUasg_Contrato = function(v_url_contratante, v_url_contrato_WS, v_url_contrato_Existe, v_url_contrato_Exclusao, url_contrato_Reativar, url_contrato_BD, url_modalidade_BD) {
    var v_coUasg = $('#co_uasg').val();
    var v_nuContrato = $('#nr_contrato').val().replace(/[^\d]+/g,'');
    
    if (v_coUasg.length == 6)
    {
        $.ajax({
            url: v_url_contratante + "/" + v_coUasg,
            type: 'GET',
            dataType: 'json',
            contentType: false, 
            processData: false,
            
            beforeSend: function() {
                    dialogCreate = bootbox.dialog({
                    message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                    closeButton: true
                });
            },
            success: function(data) {
                dialogCreate.init(function(){
                    $('#id_contratante').val(data.id_contratante);
                    
                    if (!data.representante){
                        
                        dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw orange"></i>A UASG informada não tem representante cadastrado, favor cadastrá-lo.</p>');
                        $('#nr_contrato').val('');
                        $('#co_uasg').val('');

                    }else{
                        $('#id_contratante_representante').val(data.representante.id_contratante_representante);
                        $('#nr_cpf').val(data.representante.nr_cpf_representante);
                        $('#nr_rg').val(data.representante.nr_rg_representante);
                        $('#no_representante_contratante').val(data.representante.no_representante);
                        $('#ds_funcao').val(data.representante.ds_funcao_representante);    
                        $('#no_contratante').val(data.orgao.no_orgao);
                        $('#sg_uf').val(data.orgao.municipio.uf.sg_uf);
                        
                        //Preenchendo a Combo de Assinantes de acordo com a UASG selecionada    
                        var selectboxAssinante = $('#id_contratante_assinante');
                        selectboxAssinante.find('option').remove();
                        $.each(data.contratante_assinantes, function (i, d) {
                            $('<option>').val(d.id_contratante_assinante).text(d.nr_cpf_assinante).appendTo(selectboxAssinante);
                            if (data.representante.nr_cpf_representante == d.nr_cpf_assinante){
                                $('#id_contratante_assinante option[value="' + d.id_contratante_assinante + '"]').attr({ selected : "selected" });
                            }
                        });
                        $('#no_assinante_contratante').val(data.representante.no_representante);
                        $('#ds_funcao_assinante').val(data.representante.ds_funcao_representante);    

                        $.fn.setDisableContratante(true);
                        $.fn.setDisableBotaoNovoAssinante(false);

                        if (v_nuContrato.length == 8){
                        
                            var url_contrato_existe = v_url_contrato_Existe + "/" + v_nuContrato + "/" + v_coUasg;
                            var retorno = false;

                            $.fn.verificaExistenciaUasg_Contrato(url_contrato_existe, function(retorno){

                                if (retorno == '1'){

                                    dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw orange"></i>O nº de contrato informado já existe. Favor verificar.</p>');
                                    $('#nr_contrato').val('');

                                }else if (retorno == '2'){

                                    dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw orange"></i>O nº de contrato informado já existe, mas foi encerrado. Favor verificá-lo nos relatórios.</p>');
                                    $('#nr_contrato').val('');

                                }else{

                                    var url_contrato_exc = v_url_contrato_Exclusao + "/" + v_nuContrato + "/" + v_coUasg;
                                    
                                    $.fn.verificaExcluidoUasg_Contrato(url_contrato_exc, function(retorno){

                                        if (retorno == '1'){

                                            dialogCreate.modal('hide');
                                            bootbox.confirm({
                                                title: "Contrato",
                                                message: "Esse contrato foi excluído, deseja ativá-lo?",
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
                                                        
                                                        var url_contrato_reativar = url_contrato_Reativar + "/" + v_nuContrato + "/" + v_coUasg;                    
                                                        $.fn.reativarExcluidoUasg_Contrato(url_contrato_reativar, function(retorno){

                                                            if (retorno == '1'){

                                                                dialogCreate.modal('show');
                                                                var url_contrato_bd = url_contrato_BD + "/" + v_nuContrato + "/" + v_coUasg;
                                                                $.get(url_contrato_bd, function (data) {
                                                                    
                                                                    window.location.href = data.rota_edicao_contrato;

                                                                });                                                                    

                                                            }

                                                        });

                                                    }

                                                }
                                            });

                                        }else{

                                            var url_contrato_ws = v_url_contrato_WS + "/" + v_nuContrato + "/" + v_coUasg;
                                            $.get(url_contrato_ws, function (data) {
                                                if (data != ""){

                                                    $('#id_modalidade').val(data.modalidade_licitacao);
                                                    $('#nr_modalidade').val(data.numero_aviso_licitacao);
                                                    $('#nr_processo').val(data.numero_processo);
                                                    $.fn.setDisableContrato(true);
                                                    $.fn.setDisableComboModalidade(data.modalidade_licitacao)
                                                    dialogCreate.modal('hide');
                                                
                                                }else{

                                                    var url_modalidades_bd = url_modalidade_BD;
                                                    $.get(url_modalidades_bd, function (data) {
                                                        $.fn.preencheComboModlidade(data);
                                                    })
                                                    $.fn.setDisableContrato(false);
                                                    dialogCreate.modal('hide');    

                                                }
                                            })
                                            .done(function( data ) {
                                                $.fn.carregarMaskNumeroModalidade();
                                                $.fn.carregarMaskNumeroProcesso();
                                                $.fn.carregarMaskNumeroCronograma();
                                            });

                                        }

                                    });
                                    
                                }

                            });

                        }else{
                            dialogCreate.modal('hide');
                        }
                    }   
                    
                }); 
            },

            error: function(){
                dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>UASG não encontrada. Favor cadastrá-la.</p>');

                $('#formulario').each (function(){
                    this.reset();
                });
                $(".loading_spinner_uasg").hide();
            }
        })  
    }    
};

$.fn.verificaExistenciaUasg_Contrato = function(v_url, callback) {
    $.ajax({
        url: v_url,
        type: 'GET',
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        success: function(data) {
            callback(data);
        }
    })  
};


$.fn.verificaExcluidoUasg_Contrato = function(v_url, callback) {
    $.ajax({
        url: v_url,
        type: 'GET',
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        success: function(data) {
            callback(data);
        }
    })  
};

$.fn.reativarExcluidoUasg_Contrato = function(v_url, callback) {
    $.ajax({
        url: v_url,
        type: 'GET',
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        success: function(data) {
            callback(data);
        }
    })  
};