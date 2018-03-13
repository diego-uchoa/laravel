$.fn.limpa_formulário_cep = function () {
    $('#ed_logradouro').val('');
    $('#ed_complemento_logradouro').val('');
    $('#ed_bairro_logradouro').val('');
}

$.fn.busca_Campo_CEP = function (url_municipio) {
    var v_cep = $('#ed_cep_logradouro').val().replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (v_cep != "") {

        $.ajax({
            url: "https://viacep.com.br/ws/"+ v_cep +"/json/?callback=?",
            type: 'GET',
            dataType: 'json',
            contentType: false, 
            processData: false,
            
            beforeSend: function() {
                $(".loading_spinner_cep").show();
            },
            success: function(data) {
                $("#ed_logradouro").val(data.logradouro);
                $("#ed_complemento_logradouro").val(data.complemento);
                $("#ed_bairro_logradouro").val(data.bairro);
                
                $('#id_uf_logradouro option').filter(function() { 
                    return ($(this).text() == data.uf);
                }).prop('selected', true);

                $.fn.busca_Municipios_UF(url_municipio);

                $(".loading_spinner_cep").hide();
            },
            error: function(){
                $(".loading_spinner_cep").hide();
            }
        });
    }
    else {
        $.fn.limpa_formulário_cep();
    }
}