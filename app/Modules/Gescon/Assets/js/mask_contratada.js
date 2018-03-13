$.fn.change_Campo_CPF_CNPJ = function () {

    var tipo = $('#in_tipo_contratada');
    var cnpj = $('#nr_cpf_cnpj');

    if(tipo.val() == 'PF'){
        $('.input-mask-cpf-cnpj').mask('999.999.999-99');
    }else if(tipo.val() == 'PJ'){
        $('.input-mask-cpf-cnpj').mask('99.999.999/9999-99');
    }

    $(tipo).change(function () {
        if(tipo.val() == 'PF'){
            $('.input-mask-cpf-cnpj').mask('999.999.999-99');
        }else if(tipo.val() == 'PJ'){
            $('.input-mask-cpf-cnpj').mask('99.999.999/9999-99');
        }        
    });

}