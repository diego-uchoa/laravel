$.fn.busca_fiscal_por_cpf = function(campo, url, callback) {
    var v_cpf = campo.val().replace(/[^\d]+/g,'');
    var v_url = url + '/' + v_cpf;     
    
    if (v_cpf.length == 11)
    {
        $.ajax({
            url: v_url,
            type: 'GET',
            dataType: 'json',
            async: true,
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
                    dialogCreate.modal('hide');
                });
            },
            error: function(){
                dialogCreate.modal('hide');
            }
        });
    }  
}