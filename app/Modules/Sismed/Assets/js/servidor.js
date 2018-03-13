
    jQuery(function($) {

        //Consulta Servidor
        $('#btnFormConsultarAjax').on('click', function(e) {

            var url_create = $(this).data('url');
            var inputData = $('#formulario').serialize();
            $('#btnFormConsultarAjax').prop("disabled",true);
            
            $.ajax({
                url: url_create,
                //url: '{{ url('/sismed/servidor/consulta') }}',
                type: 'POST',
                data: inputData,

                beforeSend: function() {
                    dialogCreate = bootbox.dialog({
                        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                        closeButton: false
                    });
                },


                success: function(data) {

                    dialogCreate.init(function(){

                        if (data.status == "success"){

                            dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                            //Reload Tabela
                            $('.table-container').html(data.html);
                            $.fn.dinamic_table();   
                        }
                        else{
                            dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>');
                        }
                    
                    });    

                    setTimeout(function(){
                        $('#modal-create').hide();
                        dialogCreate.modal('hide');
                    }, 2000);

                    $('#btnFormConsultarAjax').prop("disabled",false);

                },


                error: function( data ) {

                    var result = $.parseJSON(data.responseJSON.detail);

                    var erro = '<ul class="list-unstyled spaced">';
                    $.each(result, function(i, field){
                      erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
                    });
                    erro = erro + '</ul>';

                    dialogCreate.modal('hide');
                    dialogErro = bootbox.dialog({
                      title: '<i class="ace-icon fa fa-bullhorn"></i> Alerta:',
                      message: '<p class="text-center">'+ erro +'</p>',
                      closeButton: true
                    });

                    $('#btnFormSalvarAJAX').prop("disabled",false);
                
                }


            }).done(function() {
              $("#formulario")[0].reset();
            });

            return false;
        
        });


        $('#nr_cpf').keypress(function (e) {
            return false;  
        });
    });





jQuery(function($) {

    //Remove efeito collapse do formulario
    $( "#collapse-form" ).removeClass( "collapse" );

    //Consulta Servidor
    $.fn.reset_form = function() {
        $('.form input[name=no_servidor]').val('');
        $('.form input[name=no_servidor]').prop("readonly",false);

        $('.form input[name=dt_nascimento]').val('');
        $('.form input[name=dt_nascimento]').prop("readonly",false);

        $('.form input[name=in_sexo]').val('');
        $('.form input[name=in_sexo]').prop("readonly",false);

        $('.form input[name=nr_siape]').val('');
        $('.form input[name=nr_siape]').prop("readonly",false);

        $('.form input[name=no_cargo]').val('');
        $('.form input[name=no_cargo]').prop("readonly",false);

        $('.form input[name=nr_cpf]').val('');
        $('.form input[name=nr_cpf]').prop("readonly",false);
    };
    

    $('#btnFormConsultarWsAjax').on('click', function(e) {

        $.fn.reset_form();

        var url_create = $(this).data('url');
        var inputCpf = $('#formulario-consulta input[name=nr_cpf]').val();
        var inputData = $('#formulario-consulta').serialize();
        $('#btnFormConsultarWsAjax').prop("disabled",true);
        
        $.ajax({
            url: url_create,
            type: 'POST',
            data: inputData,

            beforeSend: function() {
                dialogCreate = bootbox.dialog({
                    message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                    closeButton: false
                });
            },


            success: function(data) {

                dialogCreate.init(function(){

                    if (data.status == "success"){


                        dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');

                        var servidor = JSON.stringify (data.servidor);
                        var servidor= JSON.parse(servidor);

                        $('.form input[name=no_servidor]').val(servidor.servidor.no_servidor);
                        $('.form input[name=no_servidor]').prop("readonly",true);

                        $('.form input[name=dt_nascimento]').val(servidor.servidor.dt_nascimento);
                        $('.form input[name=dt_nascimento]').prop("readonly",true);

                        $('#in_sexo option[value='+servidor.servidor.in_sexo+']').attr('selected','selected');
                        $('.form input[name=in_sexo]').prop("readonly",true);

                        $('.form input[name=nr_siape]').val(servidor.servidor.nr_siape);
                        $('.form input[name=nr_siape]').prop("readonly",true);

                        $('.form input[name=id_siape_cargo]').val(servidor.servidor.id_siape_cargo);
                        $('.form input[name=id_siape_cargo]').prop("readonly",true);

                        $('.form input[name=no_cargo]').val(servidor.servidor.no_cargo);
                        $('.form input[name=no_cargo]').prop("readonly",true);

                        $('.form input[name=tx_regime_juridico]').val(servidor.servidor.tx_regime_juridico);
                        $('.form input[name=tx_regime_juridico]').prop("readonly",true);

                        $('.form input[name=nr_cpf]').val(servidor.servidor.nr_cpf);
                        $('.form input[name=nr_cpf]').prop("readonly",true);
                        


                    }
                    else{
                        dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>');

                        $('.form input[name=nr_cpf]').val(inputCpf);
                        $('.form input[name=nr_cpf]').prop("readonly",true);
                    }
                
                });    

                setTimeout(function(){
                    $('#modal-create').hide();
                    dialogCreate.modal('hide');
                }, 2000);

                $('#btnFormConsultarWsAjax').prop("disabled",false);

            },


            error: function( data ) {

                var result = $.parseJSON(data.responseJSON.detail);

                var erro = '<ul class="list-unstyled spaced">';
                $.each(result, function(i, field){
                  erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
                });
                erro = erro + '</ul>';

                dialogCreate.modal('hide');
                dialogErro = bootbox.dialog({
                  title: '<i class="ace-icon fa fa-bullhorn"></i> Alerta:',
                  message: '<p class="text-center">'+ erro +'</p>',
                  closeButton: true
                });

                $('#btnFormSalvarAJAX').prop("disabled",false);
            
            }


        }).done(function() {
          $("#formulario-consulta")[0].reset();
        });

        return false;
    
    });

});