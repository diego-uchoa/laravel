$.fn.busca_Municipios_UF = function (v_url) {

    var v_uf = $('#id_uf_logradouro').val();

    //Verifica se campo cep possui valor informado.
    if (v_uf != "") {

        $.ajax({
            url: v_url + "/" + v_uf,
            type: 'GET',
            dataType: 'json',
            contentType: false, 
            processData: false,
            
            beforeSend: function() {
                $(".loading_spinner_uf").show();
                $('#id_municipio_logradouro').empty();
            },
            success: function(data) {
                $.each(data, function(i, item) {
                    $("#id_municipio_logradouro").append('<option value="' + i + '">' + item + '</option>');
                });
                
                $(".loading_spinner_uf").hide();
            },
            error: function(){
                $(".loading_spinner_uf").hide();
            }
        });
    }

}