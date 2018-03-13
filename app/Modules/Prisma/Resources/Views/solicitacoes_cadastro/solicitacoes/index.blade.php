@extends('prisma::layouts.public')

@section('content')

	@section('page-header')
	    Solicitar cadastro de instituição
	@endsection

	@include('prisma::solicitacoes_cadastro.solicitacoes._introducao')

    <div class="widget-box">
        <div class="widget-header widget-header-blue widget-header-flat">
            <h4 class="widget-title lighter">Formulário de solicitação de cadastro</h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div id="fuelux-wizard-container">
                    <ul class="steps">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Instituição</span>
                        </li>
                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Responsável</span>
                        </li>
                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Editores</span>
                        </li>
                        <li data-step="4">
                            <span class="step">4</span>
                            <span class="title">Confirmação</span>
                        </li>
                    </ul>
                    <hr />
                    <div class="step-content pos-rel">
                        {!! Form::open(['route'=>'prisma::solicitacao.cadastro.store', 'id'=>'formulario']) !!}
                        <div class="alert alert-danger" id="alert-step" style="display:none">
                            <strong>
                                <i class="ace-icon fa fa-times"></i>
                                Atenção!
                            </strong>
                            Os campos em vermelho são de preenchimento obrigatório.
                            <br/>
                        </div>

                            <div class="step-pane active" data-step="1" id="step-1">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <h3 class="lighter block blue">Dados da instituição</h3>
                                    @include('prisma::solicitacoes_cadastro.solicitacoes.form._instituicao')
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="step-pane" data-step="2" id="step-2">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <h3 class="lighter block blue">Dados do responsável</h3>
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <strong><i class="ace-icon fa fa-info-circle"></i></strong> 
                                        A instituição deverá ter um único responsável. O responsável terá capacidade para gerenciar as previsões (adicionar, editar, visualizar anteriores, posições e erros no Podium) e os editores dela.
                                        <br />
                                    </div>
                                    @include('prisma::solicitacoes_cadastro.solicitacoes.form._responsavel')
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="step-pane" data-step="3" id="step-3">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <h3 class="lighter block blue">Dados dos editores</h3>
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                        </button>
                                        <strong><i class="ace-icon fa fa-info-circle"></i></strong> 
                                        A instituição poderá ter múltiplos editores, inclusive nenhum. O editor terá capacidade capacidade para gerenciar as previsões (adicionar, editar, visualizar anteriores, posições e erros no Podium).
                                        <br />
                                    </div>
                                    @include('prisma::solicitacoes_cadastro.solicitacoes.form._editores')
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="step-pane" data-step="4" id="step-4">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <h3 class="lighter block blue">Confirmação dos dados inseridos</h3>
                                    <p>Confirme abaixo se os dados inseridos estão corretos e clique em finalizar. Caso deseje alterar alguma das informações, volte ao passo correspondente e faça a alteração.</p>
                                    @include('prisma::solicitacoes_cadastro.solicitacoes._confirmacao')
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <hr />
                <div class="wizard-actions center">
                    <button class="btn btn-prev">
                        <i class="ace-icon fa fa-arrow-left"></i>Anterior
                    </button>
                    <button class="btn btn-success btn-next" data-last="Finalizar">
                        Próximo<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div>
        </div>


@endsection 

@section('script-end')
    
    @parent

        <!-- page specific plugin scripts -->
        <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/wizard.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>    

    <!--    <script src="{{ URL::asset('modules/siscontratos/js/mask_fornecedor.js') }}"></script>
            <script src="{{ URL::asset('modules/siscontratos/js/ajax_busca_cep.js') }}"></script>
            <script src="{{ URL::asset('modules/siscontratos/js/ajax_lista_municipios.js') }}"></script>
            <script src="{{ URL::asset('modules/siscontratos/js/ajax_busca_fornecedor.js') }}"></script>
            <script src="{{ URL::asset('modules/siscontratos/js/ajax_busca_dados_fiscal.js') }}"></script>
            <script src="{{ URL::asset('modules/siscontratos/js/contratos/ajax_busca_contrato.js') }}"></script>
    -->
        <script src="{{ URL::asset('modules/prisma/js/validate_campos_solicitacao_cadastro.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery.maskMoney.min.js') }}"></script>
        <script src="{{ URL::asset('js/select.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery.inputlimiter.1.3.1.min.js') }}"></script>
    


    <script type="text/javascript">

        $(function() {
            $.fn.carrega_mask = function() {
                $('.input-mask-cnpj').mask('99.999.999/9999-99');
                $('.input-mask-cpf').mask('999.999.999-99');
                $('.input-mask-telefone').focusout(function(){
                    var phone, element;
                    element = $(this);
                    element.unmask();
                    phone = element.val().replace(/\D/g, '');
                    if(phone.length > 10) {
                        element.mask("(99) 99999-999?9");
                    } else {
                        element.mask("(99) 9999-9999?9");
                    }
                }).trigger('focusout');
            };

            $(document).ready(function() {
                $.fn.carrega_mask(); 
                $('#no_relatorio').keyup(function() {
                    this.value = this.value.toUpperCase();
                }); 
            });
            
        });

        
    </script>

    <script>
        /*
        $('#fuelux-wizard-container')
            .ace_wizard()
            .on('finished.fu.wizard', function(e) {
                bootbox.dialog({
                    title: "Sucesso",
                    message: "Seu formulário foi enviado com sucesso!", 
                    buttons: {
                        "success" : {
                            "label" : "OK",
                            "className" : "btn btn-primary"
                        }
                    }
                });
            });
            */
    </script>

    <script type="text/javascript">
            jQuery(function($) {                
                
                /***********************************************************************************************
                //FUNCIONALIDADES ESPECÍFICAS DO WIZARD
                ************************************************************************************************/
                $('#fuelux-wizard-container')
                    .ace_wizard()
                    .on('actionclicked.fu.wizard' , function(e, info){
                        if (info.direction === 'previous') {
                            return;
                        }else{
                            if (info.step == 4){
                                return; 
                            }else{
                                var form = $("#formulario");
                                $.fn.validaCampos(e, info, form);        
                            }
                        }
                    })
                    .on('finished.fu.wizard', function(e) {
                        var url = document.getElementById("formulario").action;
                        var form = new FormData();
                        $.fn.desabilitarTodosCampos();
                        //Recuperando os dados do formulário
                        var formData = $('#formulario').serializeArray();    
                        jQuery.each( formData, function( i, field ) {
                            form.append(field.name, field.value);   
                        });
                        
                        console.log(form);

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
                                        
                                        setTimeout(function(){
                                            dialogCreate.modal('hide');
                                        }, 3000);
                                        
                                        window.location.href = data.redirect_url;
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
                                
                            }
                        }).done(function() {
                            $("#formulario")[0].reset();
                        });
                    });
                //Função responsável por realizar a validação dos campos do WIZARD
                $.fn.validaCampos = function(e, info, form){
                    $.fn.validacaoCamposStepCorrente(info, form);
                    if (!form.valid()){
                        e.preventDefault(); 
                        $('#alert-step').show()
                    }else{
                        $('#alert-step').hide();
                        $.fn.validacaoCamposStepProxima(info, form);
                    }
                }
                
                //Função responsável por ignorar a validação de campos do STEP CORRENTE
                $.fn.validacaoCamposStepCorrente = function(info, formulario) {
                    var step_atual = info.step;
                    var steps = formulario.find(".step-pane");
                    
                    for (i = step_atual; i < steps.length; i++){
                        fields = formulario.find('#'+steps[i].id).find(":input");
                        fields.each(function( index ) {
                            var id_campo = fields[index].id;
                            if (id_campo.indexOf('[]') == -1){
                                $('#'+fields[index].id).addClass("ignore"); 
                            }
                        });
                    }
                    
                    
                    //Função específicas para campos tratados por um botão diferente do 'Próximo'
                    $.fn.ignorarValidacaoEspecificaCamposByStep(formulario, step_atual);
                    
                }
                
                //Função responsável por validade os campos do próximo STEP
                $.fn.validacaoCamposStepProxima = function(info, formulario) {
                    var step_proximo = info.step + 1;
                    fields = formulario.find('#step-'+step_proximo).find(":input");
                    fields.each(function( index ) {
                        var id_campo = fields[index].id;
                        if (id_campo.indexOf('[]') == -1){
                            $('#'+fields[index].id).removeClass("ignore");
                        }
                    });
                }

                $.fn.desabilitarTodosCampos = function() {
                    $('#formulario input,select,textarea').each(function(){
                        $(this).prop("disabled", false);
                    });
                }
                
                //Métodos responsáveis pela funcionalidade de Data (Calendário)
                $.fn.data_picker = function() {
                    $('.date-picker').datepicker({
                        autoclose: true,
                        todayHighlight: true
                  
                    });
                    $('.data_limite').datepicker('setEndDate', new Date().toDateString())
                        .on('show', function(){
                            $('td.day.disabled').each(function(index, element){
                                var $element = $(element)
                                $element.attr("title", "A data não pode ser superior à atual");
                                $element.data("container", "body");
                                $element.tooltip()
                            });
                        });
                    $('.data_futura').datepicker('setStartDate', new Date().toDateString())
                        .on('show', function(){
                            $('td.day.disabled').each(function(index, element){
                                var $element = $(element)
                                $element.attr("title", "A data não pode ser superior à atual");
                                $element.data("container", "body");
                                $element.tooltip()
                            });
                        });
                };


                /***********************************************************************************************
                //CARREGAMENTO DAS FUNCIONALIDADES/MASCARAS
                ************************************************************************************************/
                $(document).ready(function() {
                    $('.input-mask-telefone-ddd').mask('(99) 9999-9999');
                    $('.input-mask-cpf').mask('999.999.999-99');
                    $('.input-mask-cep').mask('99.999-999');
                    $(".input-mask-money").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
                    $('.input-mask-numero-portaria').mask('999/9999');
                    $('.input-mask-numero-boletim').mask('999/9999');
                    $('.input-mask-numero-modalidade').mask('9999/9999');
                    $('.input-mask-numero-contrato').mask('9999/9999');
                    $('.input-mask-numero-processo').mask('99999.999999/9999-99');
                    $('.input-mask-numero-nota_empenho').mask('999999');
                    $('.input-mask-numero-elemento_despesa').mask('999999');
                    $('.input-mask-ano').mask('9999');
                    //$.fn.change_Campo_CPF_CNPJ();
                    $.fn.data_picker();
                });
            });
        </script>

@endsection