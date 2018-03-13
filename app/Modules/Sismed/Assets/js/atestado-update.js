jQuery(function($) {  

    $.fn.file_campos = function() {        
                $('#arquivo-atestado').ace_file_input({
                  no_file:'Nenhum Arquivo ...',
                  btn_choose:'Selecione',
                  btn_change:'Alterar',
                  droppable:false,
                  onchange:null,
                  thumbnail:false //| true | large
                  //whitelist:'gif|png|jpg|jpeg'
                  //blacklist:'exe|php'
                  //onchange:''
                  //
                });
            }

    //Tooltip
    $.fn.tooltip_campos = function() {
      $('[data-rel=tooltip]').tooltip({container:'body'});
      $('[data-rel=popover]').popover({container:'body'});
    }
    
    //Data Picker
    $.fn.data_picker = function() {
      $('.date-picker').datepicker({
             autoclose: true,
             todayHighlight: true,
             format: 'dd/mm/yyyy',                
             language: 'pt-BR'
         })
         .next().on(ace.click_event, function(){
             $(this).prev().focus();
         });
    }       

    // OK Controle campos Prazo do atestado
    $.fn.controle_campos_prazo = function() {
        $('#dt_inicio_afastamento').prop( "readonly", true );
        $('#dt_fim_afastamento').prop( "readonly", true );

        $('#te_prazo').change(function(){
          if($("#te_prazo").val()!=''){
            $('#dt_inicio_afastamento').prop( "readonly", false );
            $("#dt_inicio_afastamento").val('');
            $("#dt_fim_afastamento").val('');
          }
          else{
            $('#dt_inicio_afastamento').prop( "readonly", true );
            $("#dt_inicio_afastamento").val('');
            $("#dt_fim_afastamento").val('');
          }
              
        });



        //Calculo da data final do atestato de acordc com prazo e data inicial
        $('#dt_inicio_afastamento').change(function(){

            var prazo = parseInt($("#te_prazo").val());

            if($("#te_prazo").val() == ''){
              $(this).val('');
              alert('Digite o Prazo!');
              return false;

            }

            var data_inicio = $(this).val();
            var data_inicio = $(this).val().split("/");

            var data_final = new Date(data_inicio[2], data_inicio[1] - 1, data_inicio[0]);
            data_final.setDate(data_final.getDate() + (prazo - 1));

            if(!isNaN(data_final.getTime())){
              $("#dt_fim_afastamento").val(data_final.toInputFormat());
            } else {
              alert("Data Inválida");
              return false;
            }


            
        });
        
    }
    $.fn.controle_campos_prazo();

    //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return (dd[1]?dd:"0"+dd[0]) + "/" + (mm[1]?mm:"0"+mm[0]) + "/" + yyyy; // padding
    }; 
    

    // OK Função responsável por excluir o arquivo do atestado
    $.fn.excluir_arquivo_atestado = function() {
        $("#btn-exclur-atestado").click(function(){
            
            bootbox.confirm("Deseja realmente excluir o arquivo?", function(result){
              
                if(result){
                    
                    $('#row-anexo').hide();
                    $('#row-anexo-input').show();
                    $("input[name='atestado_delete']").val('true');

                }
            });
        });
    };

    
    // OK-- Função responsável por cancelar a exclusão do atestado
    $.fn.cancelar_exclusao_atestado = function() {
        $("#btnFormExlcuirCancelar").click(function(){
            $("#formExcluirAJAX")[0].reset();
        });
    };

    // OK-- Função responsável por carregar dados do registro a ser alterado
    $(document).on('click','.update-atestado', function() {
        var url_edit = $(this).data('url');

        dialogCreate = bootbox.dialog({
            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
            closeButton: false
        });

        $.get(url_edit, function (data) {
            dialogCreate.modal('hide');
            $('.formulario-container').html(data.html);

            $('#formulario input[name=dt_inicio_afastamento]').val(data.dataInicioAfastamento);
            $('#formulario input[name=dt_fim_afastamento]').val(data.dataFimAfastamento);

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

    // OK-- Função responsável por excluir dados do registro selecionado
    $(document).on('click','.delete-justificativa', function() {
        var url_edit = $(this).data('url');
        var id_registro = $(this).data('id');

        $('#formExcluirAJAX').attr('action', url_edit);
        
        $('input#id_atestado').val(id_registro);

        $('#modal-delete').modal('show');
    });


    //Função responsável por excluir dados do registro selecionado
    $(document).on('click','.delete-atestado', function() {
        
        var url_destroy = document.getElementById("formExcluirAJAX").action;
        var inputData = $('#formExcluirAJAX').serializeArray();
        $('#modal-delete').modal('hide');

        bootbox.confirm("Deseja realmente excluir o registro?", function(result){
            if(result){
                
                $.ajax({
                    url: url_destroy,
                    data: inputData,
                    type: 'POST',
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
                                //$.fn.dinamic_table();   

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
                }).done(function() {
                      $("#formExcluirAJAX")[0].reset();
                  });
            }
        });
    });


    $.fn.disable_campos = function() {
      $( "#in_area_atendimento" ).prop( "disabled", true );
      $( "#in_tipo_afastamento" ).prop( "disabled", true );
      $( "#in_tipo_pericia" ).prop( "disabled", true );
      $( "#in_situacao" ).prop( "disabled", true );
      $( "#nr_crm" ).prop( "readonly", true );
      $( "#no_medico" ).prop( "readonly", true );
      $( "#te_prazo" ).prop( "readonly", true );
      $( "#tx_observacao" ).prop( "readonly", true );    
    };
  
    //$.fn.disable_campos();   

    $.fn.activate_campos = function() {
        $( "#in_area_atendimento").attr('disabled', false);
        $( "#in_tipo_afastamento").attr('disabled', false);
        $( "#in_tipo_pericia").attr('disabled', false);
        $( "#in_situacao").attr('disabled', false);
        $( "#nr_crm" ).prop( "readonly", false );
        $( "#no_medico" ).prop( "readonly", false );
        $( "#te_prazo" ).prop( "readonly", false );
        $( "#tx_observacao" ).prop( "readonly", false );
    };











    $.fn.carregarFuncoes = function() {
        $.fn.data_picker();
        $.fn.tooltip_campos();
        $.fn.controle_campos_prazo();
        $.fn.excluir_arquivo_atestado();
        $.fn.cancelar_exclusao_atestado();
        $.fn.file_campos();
        $.fn.controle_input_file();
        //$('.te_prazo').off();
        //$('.dt_inicio_afastamento').off();
    };
    
    //Carregando as funções acima      
    $.fn.data_picker();
    $.fn.tooltip_campos();
    //$.fn.dinamic_table();
    $.fn.controle_campos_prazo();
    $.fn.excluir_arquivo_atestado();
    $.fn.cancelar_exclusao_atestado();
    $.fn.file_campos();
    //$('.te_prazo').off();
    //$('.dt_inicio_afastamento').off();


    // OK Função responsável por carregar dados do registro a ser alterado
    $(document).on('click','#btnFormSalvar', function() {

        dialogCreate = bootbox.dialog({
            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
            closeButton: false
        });

        

    });



});