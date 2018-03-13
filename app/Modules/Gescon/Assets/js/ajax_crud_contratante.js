/*************************************************************************************************************************
FUNCIONALIDADES REFERENTES A ASSOCIAÇÃO/DESASSOCIAÇÃO DO REPRESENTANTE DA CONTRATANTE
*************************************************************************************************************************/
$(document).on('click','.insert_representante', function(event) {
    
    var url_create = $(this).data('url');

    dialogCreate = bootbox.dialog({
        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
        closeButton: true
    });

    var url_verificacao = $(this).data('url-verificacao');
    $.get(url_verificacao, function (data) {
        
        if (!data.status){
            
            $.get(url_create, function (data) {
                dialogCreate.modal('hide');
                $('.formulario-container').html(data.html);
                $('#modal-create').modal('show');
                
                //Método responsável por adicionar o estilo ao select e a mascara, se necessário
                $('#modal-create').on('shown.bs.modal', function () {
                    $.fn.carregarFuncoes();
                    $('.update_representante').off();
                    $('.delete_representante').off();
                    $('.insert_representante').off();
                });
            })

        }else{
            
            dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw orange"></i>Não é possível adicionar um novo Representante, pois já existe um vinculado. <br>Favor desvincular o representante '+ data.representante +' para realizar o cadastro de um novo representante.</p>');

        }
        
    })
});

$(document).on('click','.update_representante', function() {
    var url_edit = $(this).data('url');

    dialogCreate = bootbox.dialog({
        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
        closeButton: false
    });

    $.get(url_edit, function (data) {
        dialogCreate.modal('hide');
        $('.formulario-container').html(data.html);
        $('#modal-create').modal('show');
        
        //Método responsável por adicionar o estilo ao select e a mascara, se necessário
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.carregarFuncoes();
            $('.update').off();
            $('.delete').off();
            $('.insert').off();
        });
    })

});

//Função responsável carregar a Modal responsável pelo desligamento do Representante
$(document).on('click','.modal_delete_representante', function(event) {
    
    var url_create = $(this).data('url');

    dialogCreate = bootbox.dialog({
        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
        closeButton: true
    });

    $.get(url_create, function (data) {
        dialogCreate.modal('hide');
        $('.formulario-container').html(data.html);
        $('#modal-desvincular').modal('show');
        
        //Método responsável por adicionar o estilo ao select e a mascara, se necessário
        $('#modal-desvincular').on('shown.bs.modal', function () {
            $.fn.carregarFuncoes();
        });
    })

});

//Função responsável por excluir dados do registro selecionado
$(document).on('click','.delete_representante', function() {
    var url = document.getElementById("formulario_data").action;
    
    var form = new FormData();

    //Recuperando os dados do formulário
    var formData = $('#formulario_data').serializeArray();    
    jQuery.each( formData, function( i, field ) {
        form.append(field.name, field.value);   
    });

    $('.delete_representante').prop("disabled",true);
    
    $.ajax({
        url: url,
        type: 'POST',
        data: form,
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        beforeSend: function() {
            dialogCreate = bootbox.dialog({
                title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                closeButton: true
            });
        },
        success: function(data) {
            dialogCreate.init(function(){
                if (data.status == "success"){
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                    dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                    
                    //Reload Tabela
                    $('.table-container-representante').html(data.html);
                    $.fn.dinamic_table_representante();   

                    setTimeout(function(){
                        $('#modal-desvincular').hide();
                        dialogCreate.modal('hide');
                    }, 3000);
                }else{
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                    var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                    if (typeof data.detail != "undefined"){
                        aviso = aviso + '<ul class="list-unstyled spaced">';    
                        aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                        aviso = aviso + '</ul>';        
                    }
                    dialogCreate.find('.bootbox-body').html(aviso);
                }
            });    

            $('.delete_representante').prop("disabled",false); 
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
            
            $('.delete_representante').prop("disabled",false);
        }
    }).done(function() {
        $("#formulario_data")[0].reset();
    });
    return false;
});

$(document).on('click','.store_representante', function() {
    var url = document.getElementById("formulario").action;
    
    var form = new FormData();

    //Recuperando os dados do formulário
    var formData = $('#formulario').serializeArray();    
    jQuery.each( formData, function( i, field ) {
        form.append(field.name, field.value);   
    });

    $('.store_representante').prop("disabled",true);
    
    $.ajax({
        url: url,
        type: 'POST',
        data: form,
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        beforeSend: function() {
            dialogCreate = bootbox.dialog({
                title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                closeButton: true
            });
        },
        success: function(data) {
            dialogCreate.init(function(){
                if (data.status == "success"){
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                    dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                    
                    //Reload Tabela
                    $('.table-container-representante').html(data.html);
                    $.fn.dinamic_table_representante();   

                    setTimeout(function(){
                        $('#modal-create').hide();
                        dialogCreate.modal('hide');
                    }, 3000);
                }else{
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                    var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                    if (typeof data.detail != "undefined"){
                        aviso = aviso + '<ul class="list-unstyled spaced">';    
                        aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                        aviso = aviso + '</ul>';        
                    }
                    dialogCreate.find('.bootbox-body').html(aviso);
                }
            });    

            $('.store_representante').prop("disabled",false); 
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
            
            $('.store_representante').prop("disabled",false);
        }
    }).done(function() {
        $("#formulario")[0].reset();
    });
    return false;
});


/*************************************************************************************************************************
FUNCIONALIDADES REFERENTES A ASSOCIAÇÃO/DESASSOCIAÇÃO DO USUÁRIO DA CONTRATANTE
*************************************************************************************************************************/
$(document).on('click','.insert_usuario', function(event) {
    
    var url_create = $(this).data('url');

    dialogCreate = bootbox.dialog({
        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
        closeButton: true
    });

    $.get(url_create, function (data) {
        dialogCreate.modal('hide');
        $('.formulario-container').html(data.html);
        $('#modal-create').modal('show');
        
        //Método responsável por adicionar o estilo ao select e a mascara, se necessário
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.carregarFuncoes();
            $('.store_usuario').off();
            $('.delete_usuario').off();
            $('.insert_usuario').off();
        });
    })

});

//Função responsável por excluir dados do registro selecionado
$(document).on('click','.delete_usuario', function() {
    var url_destroy = $(this).data("url");
    
    bootbox.confirm("Deseja realmente excluir o registro?", function(result){
        if(result){
            $.ajax({
                url: url_destroy,
                type: 'GET',
                beforeSend: function() {
                    dialogDelete = bootbox.dialog({
                        title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                        closeButton: true
                    });
                },
                success: function( data ) {
                    dialogDelete.init(function(){
                        if (data.status == "success"){
                            dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                            dialogDelete.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                            
                            //Reload Tabela
                            $('.table-container-usuario').html(data.html);
                            $.fn.dinamic_table_usuario();   

                            setTimeout(function(){
                                dialogDelete.modal('hide');
                            }, 3000);
                        }else{
                            dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                            var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                            if (typeof data.detail != "undefined"){
                                aviso = aviso + '<ul class="list-unstyled spaced">';    
                                aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                                aviso = aviso + '</ul>';    
                            }
                            dialogDelete.find('.bootbox-body').html(aviso);
                        }
                    });
                },
                error: function(data) {
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

                    dialogDelete.init(function(){
                        dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                        dialogDelete.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
                    }); 
                }
            });
        }
    });
});

//Função responsável por Inserir/Atualizar registro
$(document).on('click','.store_usuario', function() {
    var url = document.getElementById("formulario").action;
    
    var form = new FormData();

    //Recuperando os dados do formulário
    var formData = $('#formulario').serializeArray();    
    jQuery.each( formData, function( i, field ) {
        form.append(field.name, field.value);   
    });

    $('.store_usuario').prop("disabled",true);
    
    $.ajax({
        url: url,
        type: 'POST',
        data: form,
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        beforeSend: function() {
            dialogCreate = bootbox.dialog({
                title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                closeButton: true
            });
        },
        success: function(data) {
            dialogCreate.init(function(){
                if (data.status == "success"){
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                    dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                    
                    //Reload Tabela
                    $('.table-container-usuario').html(data.html);
                    $.fn.dinamic_table_usuario();   

                    setTimeout(function(){
                        $('#modal-create').hide();
                        dialogCreate.modal('hide');
                    }, 3000);
                }else{
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                    var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                    if (typeof data.detail != "undefined"){
                        aviso = aviso + '<ul class="list-unstyled spaced">';    
                        aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                        aviso = aviso + '</ul>';        
                    }
                    dialogCreate.find('.bootbox-body').html(aviso);
                }
            });    

            $('.store_usuario').prop("disabled",false); 
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
            
            $('.store_usuario').prop("disabled",false);
        }
    }).done(function() {
        $("#formulario")[0].reset();
    });
    return false;
});

/*************************************************************************************************************************
FUNCIONALIDADES REFERENTES A ASSOCIAÇÃO/DESASSOCIAÇÃO DO ASSINANTE DA CONTRATANTE
*************************************************************************************************************************/
$(document).on('click','.insert_assinante', function(event) {
    
    var url_create = $(this).data('url');
    
    dialogCreate = bootbox.dialog({
        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
        closeButton: true
    });

    $.get(url_create, function (data) {
        dialogCreate.modal('hide');
        $('.formulario-container').html(data.html);
        $('#modal-create').modal('show');
        
        //Método responsável por adicionar o estilo ao select e a mascara, se necessário
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.carregarFuncoes();
            $('.update_assinante').off();
            $('.delete_assinante').off();
            $('.insert_assinante').off();
        });
    })

});

$(document).on('click','.update_assinante', function() {
    var url_edit = $(this).data('url');

    dialogCreate = bootbox.dialog({
        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
        closeButton: false
    });

    $.get(url_edit, function (data) {
        dialogCreate.modal('hide');
        $('.formulario-container').html(data.html);
        $('#modal-create').modal('show');
        
        //Método responsável por adicionar o estilo ao select e a mascara, se necessário
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.carregarFuncoes();
            $('.update_assinante').off();
            $('.delete_assinante').off();
            $('.insert_assinante').off();
        });
    })

});

//Função responsável por excluir dados do registro selecionado
$(document).on('click','.delete_assinante', function() {
    var url_destroy = $(this).data("url");
    
    bootbox.confirm("Deseja realmente excluir o registro?", function(result){
        if(result){
            $.ajax({
                url: url_destroy,
                type: 'GET',
                beforeSend: function() {
                    dialogDelete = bootbox.dialog({
                        title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                        closeButton: true
                    });
                },
                success: function( data ) {
                    dialogDelete.init(function(){
                        if (data.status == "success"){
                            dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                            dialogDelete.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                            
                            //Reload Tabela
                            $('.table-container-assinante').html(data.html);
                            $.fn.dinamic_table_assinante();   

                            setTimeout(function(){
                                dialogDelete.modal('hide');
                            }, 3000);
                        }else{
                            dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                            var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                            if (typeof data.detail != "undefined"){
                                aviso = aviso + '<ul class="list-unstyled spaced">';    
                                aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                                aviso = aviso + '</ul>';    
                            }
                            dialogDelete.find('.bootbox-body').html(aviso);
                        }
                    });
                },
                error: function(data) {
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

                    dialogDelete.init(function(){
                        dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                        dialogDelete.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
                    }); 
                }
            });
        }
    });
});

$(document).on('click','.store_assinante', function() {
    var url = document.getElementById("formulario").action;
    
    var form = new FormData();

    //Recuperando os dados do formulário
    var formData = $('#formulario').serializeArray();    
    jQuery.each( formData, function( i, field ) {
        form.append(field.name, field.value);   
    });

    $('.store_assinante').prop("disabled",true);
    
    $.ajax({
        url: url,
        type: 'POST',
        data: form,
        dataType: 'json',
        contentType: false, 
        processData: false,
        
        beforeSend: function() {
            dialogCreate = bootbox.dialog({
                title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                closeButton: true
            });
        },
        success: function(data) {
            dialogCreate.init(function(){
                if (data.status == "success"){
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                    dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                    
                    //Reload Tabela
                    $('.table-container-assinante').html(data.html);
                    $.fn.dinamic_table_assinante();   

                    setTimeout(function(){
                        $('#modal-create').hide();
                        dialogCreate.modal('hide');
                    }, 3000);
                }else{
                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                    var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                    if (typeof data.detail != "undefined"){
                        aviso = aviso + '<ul class="list-unstyled spaced">';    
                        aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                        aviso = aviso + '</ul>';        
                    }
                    dialogCreate.find('.bootbox-body').html(aviso);
                }
            });    

            $('.store_assinante').prop("disabled",false); 
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
            
            $('.store_assinante').prop("disabled",false);
        }
    }).done(function() {
        $("#formulario")[0].reset();
    });
    return false;
});