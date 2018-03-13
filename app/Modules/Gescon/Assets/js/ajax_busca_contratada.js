$.fn.busca_Contratada = function (campo, v_url, callback) {

    var v_cpf_cnpj = campo.val().replace(/[^\d]+/g,'');
    
    if (v_cpf_cnpj.length == 14)
    {
        $.ajax({
            url: v_url + "/" + v_cpf_cnpj,
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
                    callback(data);
                });
            },
            error: function(){
                dialogCreate.modal('hide');
            }
        });
    }
   
}