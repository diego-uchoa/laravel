jQuery(function($) {
    
    //Função responsável por limpar os dados do formulário Modal e disponibilizá-lo para cadastro
    $(document).on('click','.insert', function(event) {

        var url_create = $(this).data('url');

        dialogCreate = bootbox.dialog({
            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
            closeButton: false
        });

        $.get(url_create, function (data) {
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

    
    //Função responsável por Inserir/Atualizar registro
    $(document).on('click','#btnFormSalvarAJAX', function() {
        var url = document.getElementById("formulario").action;
        
        var form = new FormData();

        //Recuperando os arquivos de upload, se houver
        var qtd_input_files = $('#formulario input[type="file"]').length;
        for (var i = 0; i < qtd_input_files; i++)
        {
            var qtd_files = $('#formulario input[type="file"]')[i].files.length;   
            var name = $('#formulario input[type="file"]')[i].name;
            for (var j = 0; j < qtd_files; j++)
            {
                form.append(name, $('#formulario input[type="file"]')[i].files[j]);   
            }
        }
        
        //Recuperando os dados do formulário
        var formData = $('#formulario').serializeArray();    
        jQuery.each( formData, function( i, field ) {
            form.append(field.name, field.value);   
        });

        $('#btnFormSalvarAJAX').prop("disabled",true);
        
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
                        $('.table-container').html(data.html);
                        $.fn.dinamic_table();   

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

                $('#btnFormSalvarAJAX').prop("disabled",false); 
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
                
                $('#btnFormSalvarAJAX').prop("disabled",false);
            }
        }).done(function() {
            $("#formulario")[0].reset();
        });
        return false;
    });


    //Função responsável por carregar dados do registro a ser alterado
    $(document).on('click','.update', function() {
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


    //Função responsável por excluir dados do registro selecionado
    $(document).on('click','.delete', function() {
        var url_destroy = $(this).data("url");
        var id_registro = $(this).data("id");
        
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
                                $('.table-container').html(data.html);
                                $.fn.dinamic_table();   

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

                        dialogCreate.init(function(){
                            dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                            dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
                        }); 
                    }
                });
            }
        });
    });
    
});