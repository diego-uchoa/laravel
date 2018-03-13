/****************************************************************************************************************
//CONTROLE DE VALIDAÇÃO DE CAMPOS DO STEP 'CONTRATADA' REFERENTE AOS CAMPOS CRIADOS DINAMICAMENTE
*****************************************************************************************************************/
$.fn.verificaPreenchimentoCamposPreposto = function(e, formulario, step) {
    if (step == 2){
        if (($('#no_preposto').val() != "") && ($('#nr_telefone_preposto').val() != "") && ($('#ds_email_preposto').val() != "")){

            e.preventDefault(); 
            bootbox.confirm({
                title: "Alerta",
                message: "Verifiquei que você informou dados do Preposto mas não os adicionou na lista, gostaria de adicioná-los?",
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

                        $("#adiciona-preposto").trigger('click');

                    }else{

                        $.fn.setValorVazioPreposto();

                    }

                }
            });

        }

    }
}

$.fn.ignorarValidacaoCamposPreposto = function(formulario, step) {
    if (step == 2){
    	fields = formulario.find('#step-2').find(".row_preposto").find(":input");
        fields.each(function( index ) {
            $('#'+fields[index].id).addClass('ignore');
        });
    }
}

$.fn.validacaoCamposPreposto = function() {
    var formulario = $("#formulario");
    fields = formulario.find('#step-2').find(".row_preposto").find(":input");
    fields.each(function( index ) {
        $('#'+fields[index].id).removeClass('ignore');
    });

    var validator = formulario.validate();
    validator.element("#no_preposto");
    validator.element("#nr_telefone_preposto");
    validator.element("#ds_email_preposto");

    if (validator.element("#no_preposto") && validator.element("#nr_telefone_preposto") && validator.element("#ds_email_preposto")){
        return true;
    }else{
        return false;
    }
}
/****************************************************************************************************************/
/****************************************************************************************************************/


/****************************************************************************************************************
//CONTROLE DE VALIDAÇÃO DE CAMPOS DO STEP 'CONTRATAÇÃO' REFERENTE AOS CAMPOS CRIADOS DINAMICAMENTE
*****************************************************************************************************************/
$.fn.verificaPreenchimentoCamposItens = function(e, formulario, step) {
    if (step == 3){
        if (($('#id_tipo_item').val() != "") && ($('#id_unidade_medida').val() != "") && ($('#qt_item_contratacao').val() != "") && ($('#vl_item_contratacao').val() != "")){

            e.preventDefault(); 
            bootbox.confirm({
                title: "Alerta",
                message: "Verifiquei que você informou dados do Item de Contratação mas não os adicionou na lista, gostaria de adicioná-los?",
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

                        $("#adiciona-item").trigger('click');

                    }else{

                        $.fn.setValorVazioItemContratacao();

                    }

                }
            });

        }

    }
}

$.fn.ignorarValidacaoCamposItens = function(formulario, step) {
    if (step == 3){
        fields = formulario.find('#step-3').find(".row_item").find(":input");
        fields.each(function( index ) {
            $('#'+fields[index].id).addClass('ignore');
        }); 
    }
}

$.fn.validacaoCamposItens = function() {
    var formulario = $("#formulario");
    fields = formulario.find('#step-3').find(".row_item").find(":input");
    fields.each(function( index ) {
        $('#'+fields[index].id).removeClass('ignore');
    });

    var validator = formulario.validate();
    validator.element("#id_tipo_item");
    validator.element("#qt_item_contratacao");
    validator.element("#id_unidade_medida");
    validator.element("#vl_item_contratacao");

    if (validator.element("#id_tipo_item") && validator.element("#qt_item_contratacao") && validator.element("#id_unidade_medida") && validator.element("#vl_item_contratacao")){
        return true;
    }else{
        return false;
    }
}
/****************************************************************************************************************/
/****************************************************************************************************************/


/****************************************************************************************************************
//CONTROLE DE VALIDAÇÃO DE CAMPOS DO STEP 'DATAS/PAGAMENTO/VARIAÇÃO' REFERENTE AOS CAMPOS CRIADOS DINAMICAMENTE
*****************************************************************************************************************/
$.fn.verificaPreenchimentoCamposProcessosPagamento = function(e, formulario, step) {
    if (step == 4){
        if (($('#nr_nota_empenho').val() != "")){

            e.preventDefault(); 
            bootbox.confirm({
                title: "Alerta",
                message: "Verifiquei que você informou dados do Processo de Pagamento mas não os adicionou na lista, gostaria de adicioná-los?",
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

                        $("#adiciona-processo").trigger('click');

                    }else{

                        $.fn.setValorVazioProcessoPagamento();    

                    }

                }
            });

        }

    }
}

$.fn.ignorarValidacaoCamposProcessosPagamento = function(formulario, step) {
    if (step == 4){
        fields = formulario.find('#step-4').find(".row_processo").find(":input");
        fields.each(function( index ) {
            $('#'+fields[index].id).addClass('ignore');
        });
    }
}

$.fn.validacaoCamposProcessosPagamento = function() {
    var formulario = $("#formulario");
    fields = formulario.find('#step-4').find(".row_processo").find(":input");
    fields.each(function( index ) {
        $('#'+fields[index].id).removeClass('ignore');
    });

    var validator = formulario.validate();
    validator.element("#nr_nota_empenho");

    if (validator.element("#nr_nota_empenho")){
        return true;
    }else{
        return false;
    }
}
/****************************************************************************************************************/
/****************************************************************************************************************/


/****************************************************************************************************************
//CONTROLE DE VALIDAÇÃO DE CAMPOS DO STEP 'FISCAL' REFERENTE AOS CAMPOS CRIADOS DINAMICAMENTE
*****************************************************************************************************************/
$.fn.verificaPreenchimentoCamposFiscais = function(e, formulario, step) {
    if (step == 5){
        if (($('#in_tipo_fiscal').val() != "") && ($('#nr_cpf_titular').val() != "") && ($('#no_titular').val() != "") && ($('#nr_matricula_titular').val() != "") && ($('#ds_email_titular').val() != "") && ($('#nr_portaria').val() != "") && ($('#dt_inicio_fiscal').val() != "") && ($('#nr_boletim').val() != "")){

            e.preventDefault(); 
            bootbox.confirm({
                title: "Alerta",
                message: "Verifiquei que você informou dados do Fiscal mas não os adicionou na lista, gostaria de adicioná-los?",
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

                        $("#adiciona-fiscal").trigger('click');

                    }else{

                        $.fn.setValorVazioFiscal();     

                    }

                }
            });

        }

    }
}

$.fn.ignorarValidacaoCamposFiscais = function(formulario, step) {
    if (step == 5){
        fields = formulario.find('#step-5').find(".row_fiscal").find(":input");
        fields.each(function( index ) {
            $('#'+fields[index].id).addClass('ignore');
        });
    }
}

$.fn.validacaoCamposFiscais = function() {
    var formulario = $("#formulario");
    fields = formulario.find('#step-5').find(".row_fiscal").find(":input");
    fields.each(function( index ) {
        if ($('#'+fields[index].id).val().indexOf("substituto") != -1){
            $('#'+fields[index].id).removeClass('ignore');    
        }
    });
    $('#id_titular').addClass('ignore');
    $('#id_substituto').addClass('ignore');

    var validator = formulario.validate();
    validator.element("#in_tipo_fiscal");
    validator.element("#nr_cpf_titular");
    validator.element("#no_titular");
    validator.element("#nr_matricula_titular");
    validator.element("#ds_email_titular");
    validator.element("#nr_portaria");
    validator.element("#dt_inicio_fiscal");
    validator.element("#nr_boletim");

    if (validator.element("#in_tipo_fiscal") && validator.element("#nr_cpf_titular") && validator.element("#no_titular") && validator.element("#nr_matricula_titular") && validator.element("#ds_email_titular") && validator.element("#nr_portaria") && validator.element("#dt_inicio_fiscal") && validator.element("#nr_boletim")){
            
        if ($('#nr_cpf_substituto').val() != ""){
            validator.element("#nr_cpf_substituto");
            validator.element("#no_substituto");
            validator.element("#nr_matricula_substituto");
            validator.element("#ds_email_substituto");

            if (validator.element("#nr_cpf_substituto") && validator.element("#no_substituto") && validator.element("#nr_matricula_substituto") && validator.element("#ds_email_substituto")){
                return true;
            }else{
                return false;        
            }
        }else{
            return true;    
        }
        
    }else{
        return false;
    }
}
/****************************************************************************************************************/
/****************************************************************************************************************/


/****************************************************************************************************************
//CONTROLE DE VALIDAÇÃO DE CAMPOS DO STEP 'INFORMAÇÕES ADICIONAIS' REFERENTE AOS CAMPOS CRIADOS DINAMICAMENTE
*****************************************************************************************************************/
$.fn.verificaPreenchimentoCamposOutrasInformacoes = function(e) {

    if (($('#id_informacao').val() != "") && ($('#ds_informacao').val() != "")){

        e.preventDefault(); 
        bootbox.confirm({
            title: "Alerta",
            message: "Verifiquei que você informou dados de Informações Adicionais mas não os adicionou na lista, gostaria de adicioná-los?",
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

                    $("#adiciona-informacao").trigger('click');

                }else{

                    $.fn.setValorVazioInformacaoAdicional();
                    $.fn.enviarFormulario();

                }

            }
        });

    }else{

        $.fn.enviarFormulario();

    }

}

$.fn.ignorarValidacaoCamposOutrasInformacoes = function(formulario, step) {
    if (step == 6){
        fields = formulario.find('#step-6').find(".row_informacao").find(":input");
        fields.each(function( index ) {
            $('#'+fields[index].id).addClass('ignore');
        });
    }
}

$.fn.validacaoCamposOutrasInformacoes = function() {
    var formulario = $("#formulario");
    fields = formulario.find('#step-6').find(".row_informacao").find(":input");
    fields.each(function( index ) {
        $('#'+fields[index].id).addClass('ignore');
    });

    var validator = formulario.validate();
    validator.element("#id_informacao");
    validator.element("#ds_informacao");

    if (validator.element("#id_informacao") && validator.element("#ds_informacao")){
        return true;
    }else{
        return false;
    }
}
/****************************************************************************************************************/
/****************************************************************************************************************/