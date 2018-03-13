//Função responsável por recuperar dados do usuário no WS SIAPE através do CPF
$(document).on('click','#bt_buscar_cpf', function() {

    var v_cpf = $('#nr_cpf_representante').val().replace(/[^\d]+/g,'');
    var site = window.location.protocol + "//" + window.location.host;
    var url = site + "/portal/profile/dados/" + v_cpf;     
    
    if (v_cpf.length == 11)
    {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            contentType: false, 
            processData: false,
            
            beforeSend: function() {
                $(".loading_spinner_representante").show();
				$.fn.setDisabled(true);
            },
            success: function(data) {
            	$('#no_representante').val(data.nome);
                $(".loading_spinner_representante").hide();
                $.fn.setDisabled(false);
            },
            error: function(){
                $(".loading_spinner_representante").hide();    
                $.fn.setDisabled(false);
            }
        });
    }    

});