jQuery(function($) {  

    $.fn.file_campos = function() {        
                $('#arquivo-laudo').ace_file_input({
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



    // OK Controle visão input file Laudo
    $.fn.controle_input_file = function() {
        if($('#in_situacao').val() == 'C'){
          $('#formulario-pericia input[name=laudo]').removeAttr('disabled');
        }
        else{
          $('#formulario-pericia input[name=laudo]').attr("disabled", "disabled");
        }
    };

    

    $(document).on('change', '#in_situacao_pericia', function() {
        if($('#in_situacao_pericia').val() == 'C'){
          $('#formulario-pericia input[name=laudo]').removeAttr('disabled');
        }
        else{
          $('#formulario-pericia input[name=laudo]').attr("disabled", "disabled");
        }
    });

           

    // OK Controle campos Prazo do atestado
    $.fn.controle_campos_prazo_pericia = function() {
        $('#dt_inicio_afastamento_pericia').prop( "readonly", true );
        $('#dt_fim_afastamento_pericia').prop( "readonly", true );

        $('#te_prazo_pericia').change(function(){
          if($("#te_prazo_pericia").val()!=''){
            $('#dt_inicio_afastamento_pericia').prop( "readonly", false );
            $("#dt_inicio_afastamento_pericia").val('');
            $("#dt_fim_afastamento_pericia").val('');
          }
          else{
            $('#dt_inicio_afastamento_pericia').prop( "readonly", true );
            $("#dt_inicio_afastamento_pericia").val('');
            $("#dt_fim_afastamento_pericia").val('');
          }
              
        });



        //Calculo da data final do atestato de acordc com prazo e data inicial
        $('#dt_inicio_afastamento_pericia').change(function(){

            var prazo = parseInt($("#te_prazo_pericia").val());

            if($("#te_prazo_pericia").val() == ''){
              $(this).val('');
              alert('Digite o Prazo!');
              return false;

            }

            var data_inicio = $(this).val();
            var data_inicio = $(this).val().split("/");

            var data_final = new Date(data_inicio[2], data_inicio[1] - 1, data_inicio[0]);
            data_final.setDate(data_final.getDate() + (prazo - 1));

            if(!isNaN(data_final.getTime())){
              $("#dt_fim_afastamento_pericia").val(data_final.toInputFormat());
            } else {
              alert("Data Inválida");
              return false;
            }


            
        });
        
    }
    $.fn.controle_campos_prazo_pericia();

    //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return (dd[1]?dd:"0"+dd[0]) + "/" + (mm[1]?mm:"0"+mm[0]) + "/" + yyyy; // padding
    }; 
    

    // OK Função responsável por excluir o arquivo do atestado
    $.fn.excluir_arquivo_laudo_pericia = function() {
        $("#btn-exclur-laudo-pericia").click(function(){
            
            bootbox.confirm("Deseja realmente excluir o arquivo?", function(result){
              
                if(result){

                    $('#row-laudo').hide();
                    $('#row-laudo-input-pericia').show();
                    $("#formulario-pericia input[name='laudo_delete']").val('true');

                    if($('#in_situacao').val() == 'C'){
                      $('#formulario-pericia input[name=laudo]').removeAttr('disabled');
                    }
                    else{
                      $('#formulario-pericia input[name=laudo]').attr("disabled", "disabled");
                    }
                    

                }
            });
        });
    };


    $.fn.carregarFuncoes = function() {
        $.fn.data_picker();
        $.fn.tooltip_campos();
        $.fn.controle_campos_prazo_pericia();
        $.fn.excluir_arquivo_laudo_pericia();
        $.fn.file_campos();
        $.fn.controle_input_file();
        //$('.te_prazo').off();
        //$('.dt_inicio_afastamento').off();
    };
    
    //Carregando as funções acima
    $.fn.data_picker();      
    $.fn.tooltip_campos();
    $.fn.controle_campos_prazo_pericia();
    $.fn.excluir_arquivo_laudo_pericia();
    $.fn.file_campos();
    $.fn.controle_input_file();
    //$('.te_prazo').off();
    //$('.dt_inicio_afastamento').off();



    // OK Função responsável por carregar dados do registro a ser alterado
    $(document).on('click','.update-pericia', function() {
        var url_edit = $(this).data('url');

        dialogCreate = bootbox.dialog({
            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
            closeButton: false
        });

        $.get(url_edit, function (data) {
            dialogCreate.modal('hide');
            $('.formulario-container').html(data.html);

            $('#formulario-pericia input[name=dt_inicio_afastamento]').val(data.dataInicioAfastamento);
            $('#formulario-pericia input[name=dt_fim_afastamento]').val(data.dataFimAfastamento);
            $('#formulario-pericia input[name=dt_pericia]').val(data.dataPericia);

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
    $(document).on('click','#btnFormSalvarAJAX-pericia', function() {

        var url = document.getElementById("formulario-pericia").action;
        
        var form = new FormData();

        //Recuperando os arquivos de upload, se houver
        var qtd_input_files = $('#formulario-pericia input[type="file"]').length;
        for (var i = 0; i < qtd_input_files; i++)
        {
            var qtd_files = $('#formulario-pericia input[type="file"]')[i].files.length;   
            var name = $('#formulario-pericia input[type="file"]')[i].name;
            for (var j = 0; j < qtd_files; j++)
            {
                form.append(name, $('#formulario-pericia input[type="file"]')[i].files[j]);   
            }
        }
        
        //Recuperando os dados do formulário
        var formData = $('#formulario-pericia').serializeArray();     
        jQuery.each( formData, function( i, field ) {
            form.append(field.name, field.value);   
        });

        //$('#btnFormSalvarAJAX').prop("disabled",true);
        
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
                        $('.table-pericia-container').html(data.html);

                        console.log(data.atualiza);
                        if(data.atualiza != false){
                            $('#formulario select[name=in_situacao]').val(data.atualiza);

                            var alert = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Situação do Atestado alterada.</div>";
                            
                            $(alert).insertAfter('#breadcrumbs');
                        }
                          

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

                $('#btnFormSalvarAJAX-pericia').prop("disabled",false); 
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
                
                $('#btnFormSalvarAJAX-pericia').prop("disabled",false);
            }
        }).done(function() {
            $("#formulario-pericia")[0].reset();
        });
        return false;
    });





});