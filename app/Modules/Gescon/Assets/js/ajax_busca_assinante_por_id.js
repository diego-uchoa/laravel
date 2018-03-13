//Função responsável por recuperar dados do assinante pela ID
$.fn.busca_assinante_por_id = function(campo, url, callback) {
    var v_id = campo.val();
    var v_url = url + '/' + v_id;     
    
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