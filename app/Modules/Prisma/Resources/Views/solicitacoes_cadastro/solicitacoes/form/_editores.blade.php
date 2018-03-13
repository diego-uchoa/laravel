<div id="lista-editores">
    <div class="widget-box widget-color-default">
        <div class="widget-header">
            <h5 class="widget-title blue">Editor</h5>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <div class="row row_item">
                    <div class="col-lg-2">
                        <div class="form-group">
                            {!! Form::label('nr_cpf_editor', 'CPF:') !!}
                            {!! Form::text('nr_cpf_editor', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf_editor']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('no_editor', 'Nome:') !!}
                            {!! Form::text('no_editor', null, ['class'=>'form-control', 'no_editor' => 'no_editor']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            {!! Form::label('nr_telefone_editor', 'Telefone:') !!}
                            {!! Form::text('nr_telefone_editor', null, ['class'=>'form-control  input-mask-telefone', 'nr_telefone_editor' => 'nr_telefone_editor']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            {!! Form::label('ds_email_editor', 'E-mail:') !!}
                            {!! Form::email('ds_email_editor', null, ['class'=>'form-control', 'ds_email_editor' => 'ds_email_editor']) !!}
                        </div>
                    </div>
                    {!! Form::button('<i class="fa fa-check"></i> Adicionar editor', ['class'=>'btn btn-sm btn-success pull-right', 'id' => 'adiciona-item', 'style' => 'margin-right: 10px']) !!}
                </div>
            </div>
        </div>
    </div>
    <br>
</div>


<br><br>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box widget-color-grey" id="div-itens" style="display:none">
            <div class="widget-header widget-header-small">
            <h5 class="widget-title smaller">Editores Adicionados</h5>
            </div>
            <div class="widget-body">
                <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover" id="lista-itens">
                        <tbody>
                            <tr>
                                <th>CPF</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Ação</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script-end')
    @parent
    <script type="text/javascript">

        $(document).ready(function(){

            $.fn.ignorarValidacaoEspecificaCamposByStep = function(formulario, step_atual){
                
                $.fn.ignorarValidacaoCamposItens(formulario, step_atual);
                //$.fn.ignorarValidacaoCamposProcessosPagamento(formulario, step_atual);
                //$.fn.ignorarValidacaoCamposOutrasInformacoes(formulario, step_atual);
                //$.fn.ignorarValidacaoCamposFiscais(formulario, step_atual);
                //$.fn.ignorarValidacaoCamposPreposto(formulario, step_atual);
            }      

            
            $('#adiciona-item').click(function(){  
                var nr_cpf_editor = $('#nr_cpf_editor').val();
                var no_editor = $('#no_editor').val();              
                var nr_telefone_editor = $('#nr_telefone_editor').val();       
                var ds_email_editor = $('#ds_email_editor').val();


                if ($.fn.validacaoCamposItens()){
                    if ($('#div-itens').hide()){
                        $('#div-itens').show();
                        $('#alert-step').hide();
                    }

                    var newRow = $("<tr>");         
                    var cols = "";      
                    cols += '<td width="20%">';
                    cols += '<input id="nr_cpf_editor_adicionada[]" name="nr_cpf_editor_adicionada[]" type="hidden" value="'+ nr_cpf_editor +'">'+ nr_cpf_editor;
                    cols += '</td>';
                    cols += '<td width="35%">';
                    cols += '<input id="no_editor_adicionada[]" name="no_editor_adicionada[]" type="hidden" value="'+ no_editor +'">'+ no_editor; 
                    cols += '</td>';
                    cols += '<td width="20%">';
                    cols += '<input id="nr_telefone_editor_adicionada[]" name="nr_telefone_editor_adicionada[]" type="hidden" value="'+ nr_telefone_editor +'">'+ nr_telefone_editor;
                    cols += '</td>';
                    cols += '<td width="10%">';
                    cols += '<input id="ds_email_editor_adicionada[]" name="ds_email_editor_adicionada[]" type="hidden" value="'+ ds_email_editor +'">'+ ds_email_editor;
                    cols += '</td>';
                    cols += '<td width="5%">';
                    cols += '<button type="button" class="btn btn-xs btn-danger btn-remove-item pull-center" data-rel="tooltip" data-original-title="Excluir Item"><i class="ace-icon fa fa-trash-o"/></button>';
                    cols += '</td>';
                    newRow.append(cols);
                    $("#lista-itens").append(newRow);

                    $.fn.setValorVazio();
                }else{
                    $('#alert-step').show();
                }
            })


            $(document).on('click', '.btn-remove-item', function(){  
                var tr = $(this).closest('tr');     
                tr.fadeOut(400, function() {              
                    tr.remove();            
                });     
                if ($('#lista-itens tbody').find('tr').length == 2){
                    $('#div-itens').fadeOut(400, function() {             
                        $('#div-itens').hide();
                    });     
                }
            });


            $.fn.ignorarValidacaoCamposItens = function(formulario, step) {
                if (step == 3){
                    fields = formulario.find('#step-3').find(".row_item").find(":input");
                    fields.each(function( index ) {
                        $('#'+fields[index].id).addClass('ignore');
                    }); 
                }
            }


            $.fn.validacaoCamposItens = function() {
                var formulario = $("#formulario");
                fields = formulario.find('#step-3').find(".row_item").find(":input");
                fields.each(function( index ) {
                    $('#'+fields[index].id).removeClass('ignore');
                });

                var validator = formulario.validate();
                validator.element("#nr_cpf_editor");
                validator.element("#no_editor");
                validator.element("#nr_telefone_editor");
                validator.element("#ds_email_editor");

                if (validator.element("#nr_cpf_editor") && validator.element("#no_editor") && validator.element("#nr_telefone_editor") && validator.element("#ds_email_editor")){
                    return true;
                }else{
                    return false;
                }
            }


            $.fn.setValorVazio = function() {
                $('#nr_cpf_editor').val("");
                $('#no_editor').val("");
                $('#nr_telefone_editor').val("");
                $('#ds_email_editor').val("");
            }














        });










        $(document).ready(function(){      
            var i=1;  

            $('#adiciona-editor').click(function(){  
                i++;  
                $('#lista-editores').append(
                    '<div id="row-editor-'+i+'"class="widget-box widget-color-default"><div class="widget-header"><h5 class="widget-title blue">Editor</h5><button class="btn btn-danger pull-right btn-remove-editor" name="remove" id="'+i+'"><i class="fa fa-trash-o"></i> Remover editor</button></div><div class="widget-body"><div class="widget-main"><div class="row"><div class="col-lg-2"><div class="form-group">{!! Form::label("nr_cpf_editor[]", "CPF:") !!}{!! Form::text("nr_cpf_editor[]", null, ["class"=>"form-control input-mask-cpf", "id" => "nr_cpf_editor[]"]) !!}</div></div><div class="col-lg-4"><div class="form-group">{!! Form::label("no_editor[]", "Nome:") !!}{!! Form::text("no_editor[]", null, ["class"=>"form-control", "disabled"]) !!}</div></div><div class="col-lg-2"><div class="form-group">{!! Form::label("tx_telefone_editor[]", "Telefone:") !!}{!! Form::text("tx_telefone_editor[]", null, ["class"=>"form-control  input-mask-telefone"]) !!}</div></div><div class="col-lg-4"><div class="form-group">{!! Form::label("tx_email_editor[]", "E-mail:") !!}{!! Form::text("tx_email_editor[]", null, ["class"=>"form-control"]) !!}</div></div></div></div></div></div><br>'
                );
                $.fn.carrega_mask(); 
            }); 

            $(document).on('click', '.btn-remove-editor', function(){  
                var button_id = $(this).attr("id");   
                $('#row-editor-'+button_id+'').remove();
                $('#lista-editores').find('br:last-child').remove();  
            });  
        });  

    </script>

    <script type="text/javascript">        
    //     //Função responsável por recuperar dados do usuário no WS SIAPE através do CPF
    //     $(document).on('blur','#nr_cnpj', function() {

    //         var v_cnpj = $('#nr_cnpj').val().replace(/[^\d]+/g,'');
    //         var url = "{{ url('prisma/solicitar-cadastro/instituicao/dados/') }}" + "/" + v_cnpj;

    //         if (v_cnpj.length == 14)
    //         {
    //             $.ajax({
    //                 url: url,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 contentType: false, 
    //                 processData: false,
                    
    //                 beforeSend: function() {
    //                     dialogCreate = bootbox.dialog({
    //                         message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
    //                         closeButton: true
    //                     });
    //                 },
    //                 success: function(data) {
    //                     dialogCreate.init(function(){
                            
    //                         $('#formulario input[name=no_instituicao]').val(data.no_instituicao);
    //                         $('#formulario input[name=no_fantasia]').val(data.no_fantasia);
    //                         $('#formulario input[name=no_situacao]').val(data.no_situacao);
    //                         $('#formulario input[name=tx_telefone]').val(data.tx_telefone);
    //                         $('#formulario input[name=tx_email]').val(data.tx_email);
    //                         $('#formulario input[name=tx_logradouro]').val(data.tx_logradouro);
    //                         $('#formulario input[name=nr_logradouro]').val(data.nr_logradouro);
    //                         $('#formulario input[name=tx_complemento]').val(data.tx_complemento);
    //                         $('#formulario input[name=tx_cep]').val(data.tx_cep);
    //                         $('#formulario input[name=tx_bairro]').val(data.tx_bairro);
    //                         $('#formulario input[name=no_municipio]').val(data.no_municipio);
    //                         $('#formulario input[name=sg_uf]').val(data.sg_uf);                            


    //                         dialogCreate.modal('hide');
                            
    //                     });    
    //                 },
    //                 error: function(){
    //                     dialogCreate.modal('hide');
    //                 }
    //             });
    //         }    

    //     });

    //     //Habilitando o campo de órgão para o envio do formulário
    //     $(document).on('click','#btnFormSalvarAJAX', function() {
    //         $("#id_orgao").prop("disabled", false);
    //     });

    // </script>
@endsection