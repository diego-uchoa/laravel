//Função responsável por recuperar dados do usuário no WS SIAPE através do CPF
$(document).on('click','#bt_buscar_cpf', function() {

    var v_cpf = $('#nr_cpf').val().replace(/[^\d]+/g,'');
    var site = window.location.protocol + "//" + window.location.host;
    var url = site + "/sisadm/usuarios/verifica-perfil/" + v_cpf + "/GESCON";
    
    if (v_cpf.length == 11)
    {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            contentType: false, 
            processData: false,
            
            beforeSend: function() {
                $(".loading_spinner_usuario").show();
            },
            success: function(data) {
            	if (data != ""){
                    $('#id_usuario').val(data.id_usuario);
                    $('#no_usuario').val(data.no_usuario);
                    $('#email').val(data.email);
                    $('#no_orgao').val(data.no_orgao);
                }else{
                    $('#id_usuario').val('');
                    $('#no_usuario').val('');
                    $('#email').val('');
                    $('#no_orgao').val('');
                }
                
                $(".loading_spinner_usuario").hide();
            },
            error: function(){
                $(".loading_spinner_usuario").hide();    
            }
        });
    }    

});