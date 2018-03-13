jQuery(function($) {

  $( "#div-btn-form").hide();

  //$( "#in_situacao" ).prop( "disabled", true );

  $.fn.disable_campos = function() {
      $( "#div-btn").hide();
      $( "#nr_cpf" ).prop( "readonly", true );
      $( "#no_servidor" ).prop( "readonly", true );
      $( "#nr_rg" ).prop( "readonly", true );
      $( "#dt_nascimento" ).prop( "readonly", true );
      $( "#in_sexo").attr('disabled', true );
      $( "#ds_email" ).prop( "readonly", true );
      $( "#tx_telefone_unidade" ).prop( "readonly", true );
      $( "#tx_telefone_celular" ).prop( "readonly", true );
      $( "#tx_telefone_residencial" ).prop( "readonly", true );
      $( "#nr_siape" ).prop( "readonly", true );
      $( "#no_cargo" ).prop( "readonly", true );
      $( "#in_regime_juridico").attr('disabled', true );
      $( "#no_orgao" ).prop( "readonly", true );
      $( "#no_unidade_lotacao" ).prop( "readonly", true );
      $( "#no_unidade_exercicio" ).prop( "readonly", true );
      $( "#in_situacao_servidor" ).prop( "disabled", true ); 
      $( "#tx_local_arquivo_geral" ).prop( "readonly", true );    
  };
  
  $.fn.disable_campos();   

  $.fn.activate_campos = function() {
      $( "#no_servidor" ).prop( "readonly", false );
      $( "#nr_rg" ).prop( "readonly", false );
      $( "#dt_nascimento" ).prop( "readonly", false );
      $( "#in_sexo").attr('disabled', false);
      $( "#ds_email" ).prop( "readonly", false );
      $( "#tx_telefone_unidade" ).prop( "readonly", false );
      $( "#tx_telefone_celular" ).prop( "readonly", false );
      $( "#tx_telefone_residencial" ).prop( "readonly", false );
      $( "#nr_siape" ).prop( "readonly", false );
      $( "#no_cargo" ).prop( "readonly", false );
      $( "#in_regime_juridico").attr('disabled', false);
      $( "#no_orgao" ).prop( "readonly", false );
      $( "#no_unidade_lotacao" ).prop( "readonly", false );
      $( "#no_unidade_exercicio" ).prop( "readonly", false );
      $( "#in_situacao_servidor" ).prop( "disabled", false );
      if($('#in_situacao_servidor').val() == 'AP'){
        $( "#tx_local_arquivo_geral" ).prop( "readonly", false );   
      }
      $( "#div-btn").show();
  };

  $("#link-alterar").click(function(){

      if($("#link-alterar").attr("value") == 'alterar')
      {
        $.fn.activate_campos();
        $("#link-alterar").attr("value","cancelar");
        $("#link-alterar").attr("class","btn btn-xs btn-danger pull-right");
        $('#link-alterar').html("<i class='ace-icon fa fa-close'></i>Cancelar");
      }
      else
      {
        $.fn.disable_campos();
        $("#link-alterar").attr("value","alterar");
        $("#link-alterar").attr("class","btn btn-xs btn-info pull-right");
        $('#link-alterar').html("<i class='ace-icon fa fa-pencil'></i>Alterar");
      }
  });

  //Atualiza Servidor
    $('#div-btn').on('click', function(e) {
        
        var url_update = $(this).data('url'); 
        var inputData = $('#formulario-servidor').serialize();
        var dataId = $('#formulario-servidor').attr('data-id');

        //Desativa o botão
        $('#div-btn').prop("disabled",true);

        $.ajax({
            //url: '{{ url('/sismed/servidor/update') }}' + '/' + dataId ,
            url: url_update,
            type: 'PUT',
            data: inputData,

            beforeSend: function() {
                dialogCreate = bootbox.dialog({
                    title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                    message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                    closeButton: true
                });
            },

            success: function(data) {
              dialogCreate.init(function(){

              });

                if ( data.status === 'success' ) {

                  dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                  dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');


                  //Atualizar Dados no Formulario
                  var servidor = JSON.parse(data.servidor);
                  $('#formulario-servidor input[name=no_servidor]').val(servidor.no_servidor);
                  $('#formulario-servidor input[name=nr_rg]').val(servidor.nr_rg);
                  $('#formulario-servidor input[name=dt_nascimento]').val(servidor.dt_nascimento);
                  $('#formulario-servidor input[name=ds_email]').val(servidor.ds_email);
                  $('#formulario-servidor input[name=tx_telefone_unidade]').val(servidor.tx_telefone_unidade);
                  $('#formulario-servidor input[name=tx_telefone_celular]').val(servidor.tx_telefone_celular);
                  $('#formulario-servidor input[name=tx_telefone_residencial]').val(servidor.tx_telefone_residencial);
                  $('#formulario-servidor input[name=nr_siape]').val(servidor.nr_siape);
                  $('#formulario-servidor input[name=no_cargo]').val(servidor.no_cargo);
                  $('#formulario-servidor input[name=no_orgao]').val(servidor.no_orgao);
                  $('#formulario-servidor input[name=no_unidade_lotacao]').val(servidor.no_unidade_lotacao);
                  $('#formulario-servidor input[name=no_unidade_exercicio]').val(servidor.no_unidade_exercicio);

                  $("#link-alterar").click();

                  setTimeout(function(){
                            //dialogRetorno.modal('hide');
                            dialogCreate.modal('hide');
                        }, 3000);
                  
                  //Ativar o botão
                  $('#div-btn').prop("disabled",false); 
    
                }
            },

            error: function(data){
                if (typeof data.responseJSON == "undefined"){
                    var erro = '<ul class="list-unstyled spaced">';    
                    erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
                    erro = erro + '</ul>';    
                } else if (data.status === 422 ) {
                  var erro = '<ul class="list-unstyled spaced">';    
                  erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.msg + '</li>';
                  erro = erro + '</ul>';
                }
                else{
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
            
        });


        return false;
    });

    $('#collapse').click(function(){
        $(this).find('i').toggleClass('fa-plus').toggleClass('fa-minus');
    });


    $(document).on('change', '#in_situacao_servidor', function() {

        if($('#in_situacao_servidor').val() == 'AP'){
          $('#formulario-servidor input[name=tx_local_arquivo_geral]').removeAttr('readonly');
        }
        else{
          $('#formulario-servidor input[name=tx_local_arquivo_geral]').attr("readonly", true);
        }

    });
    

});