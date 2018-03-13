jQuery(function($) {
    $( document ).ready(function() {
        $.fn.inicia_formulario();
    });

    $.fn.carregarFuncoes = function() {
        $.fn.chosen_select();
        $.fn.data_picker();
    };
});

$(document).on('click','#btnGerarRelatorio', function() {
    var url = document.getElementById("formulario").action;
    var form = new FormData();

    var formData = $('#formulario').serializeArray();    
    jQuery.each( formData, function( i, field ) {
        form.append(field.name, field.value);   
    });

    $('#btnGerarRelatorio').prop("disabled",true);
    
    $.ajax({
        url: url,
        type: 'POST',
        data: form,
        contentType: false, 
        processData: false,
        
        beforeSend: function() {
            dialogCreate = bootbox.dialog({
                title: '<i class="ace-icon fa fa-exchange"></i> Gerando relatório',
                message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                closeButton: true
            });
        },
        success: function(data) {
            dialogCreate.init(function(){

                if (data.status == "success"){
                    $('#relatorio-row').html(data.html);   
                    dialogCreate.modal('hide'); 
                }else{
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                    var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                }
            });    

            $('#btnGerarRelatorio').prop("disabled",false); 
        },
        error: function(data){ 
            if (typeof data.responseJSON == "undefined"){
                var erro = '<ul class="list-unstyled spaced">';    
                erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
                erro = erro + '</ul>';    
            }else{
                var result = $.parseJSON(data.responseJSON.detail);
                var erro = '<ul class="list-unstyled spaced">';
                $.each(result, function(i, field){
                    erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
                });
                erro = erro + '</ul>';    
            }

            dialogCreate.init(function(){
                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
            });    
            $('#btnGerarRelatorio').prop("disabled",false);
        }
    }).done(function() { });

return false;


});