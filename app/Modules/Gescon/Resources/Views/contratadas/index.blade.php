@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::contratadas.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Contratadas
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('gescon::contratadas.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('gescon::contratadas._tabela')
    </div> 

    <div class="formulario-container">
        @include('gescon::contratadas._modal')
    </div> 

@endsection

@section('script-end')
    
    @parent

    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskTelefone.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('modules/gescon/js/mask_contratada.js') }}"></script>
    <script src="{{ URL::asset('modules/gescon/js/ajax_busca_cep.js') }}"></script>
    <script src="{{ URL::asset('modules/gescon/js/ajax_lista_municipios.js') }}"></script>
    <script src="{{ URL::asset('modules/gescon/js/ajax_busca_contratada.js') }}"></script>
    
    <script type="text/javascript">
        jQuery(function($) {                
            $.fn.dinamic_table = function() {
                var oTable = $('#dynamic-table').DataTable({
                    language: {
                      url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('gescon::contratadas.records') !!}',
                    columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                        { data: 'in_tipo_contratada', name: 'in_tipo_contratada', width: '20%' },
                        { data: 'nr_cpf_cnpj', name: 'nr_cpf_cnpj', width: '25%' },
                        { data: 'no_razao_social', name: 'no_razao_social', width: '35%' },
                        { data: 'operacoes', name: 'operacoes', width: '20%' }
                    ],
                });
            };

            $(document).ready(function() {
                $.fn.mascaraTelefone();
                $('.input-mask-cep').mask('99.999-999');
                $.fn.change_Campo_CPF_CNPJ();
                $.fn.dinamic_table(); 
            });

            $.fn.carregarFuncoes = function() {
                $.fn.mascaraTelefone();
                $('.input-mask-cep').mask('99.999-999');
                $.fn.change_Campo_CPF_CNPJ();
                $.fn.verifica_acao();
            };

            $.fn.verifica_acao = function() {
                if ($('#id_contratada').val() != ""){
                    $('#nr_cpf_cnpj').prop("disabled", true);
                    $('#in_tipo_contratada').prop("disabled", true);
                }
            };

            //Função responsável por carregar dados do registro a ser alterado
            $.fn.enviaEdicaoContratada = function($id) {
                var url_edit = "{!! url('gescon/contratadas/edit/"+$id+"') !!}";
                
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
                });

            };

            //Função responsável por recuperar dados da Contratada
            $(document).on('click','#bt_buscar_contratada', function() {
                if ($('#id_contratada').val() == ""){
                    var v_campo = $('#nr_cpf_cnpj');
                    var v_url = "{{ url('gescon/contratadas/recuperar-dados-bd/') }}";                
                    $.fn.busca_Contratada(v_campo, v_url, function(retorno){
                        if (retorno != ""){
                            if (retorno.st_cadastro == 'BD'){
                                dialogCreate.modal('hide');
                                bootbox.confirm({
                                    title: "Aviso",
                                    message: "Contratada já cadastrada. Deseja visualizar seus dados?",
                                    buttons: {
                                        cancel: {
                                            label: '<i class="fa fa-times"></i> Não'
                                        },
                                        confirm: {
                                            label: '<i class="fa fa-check"></i> Sim'
                                        }
                                    },
                                    callback: function (result) {
                                        if (result){
                                            $.fn.enviaEdicaoContratada(retorno.id_contratada);            
                                        }else{
                                            $('#nr_cpf_cnpj').val('');    
                                        }
                                    }
                                });
                            }else{
                                $('#no_razao_social').val(retorno.no_razao_social);
                                $('#ed_logradouro').val(retorno.ed_logradouro); 
                                $('#ed_numero_logradouro').val(retorno.ed_numero_logradouro); 
                                $('#ed_complemento_logradouro').val(retorno.ed_complemento_logradouro); 
                                $('#ed_bairro_logradouro').val(retorno.ed_bairro_logradouro); 
                                $('#ed_cep_logradouro').val(retorno.ed_cep_logradouro); 
                                $('#id_uf_logradouro').val(retorno.id_uf_logradouro); 

                                $('#id_municipio_logradouro').empty();
                                $.each(retorno.lista_municipios, function(i, item) {
                                    $("#id_municipio_logradouro").append('<option value="' + item.id_municipio + '">' + item.no_municipio + '</option>');
                                });
                                $("#id_municipio_logradouro").find('option[value=' + retorno.id_municipio_logradouro + ']').attr('selected', 'selected');  

                                (retorno.no_representante) ? $('#no_representante').val(retorno.no_representante) : $('#no_representante').val("");
                                (retorno.nr_telefone) ? $('#nr_telefone').val(retorno.nr_telefone) : $('#nr_telefone').val("");
                                (retorno.ds_email) ? $('#ds_email').val(retorno.ds_email) : $('#ds_email').val("");

                                $.fn.setDisableContratada(true, retorno);  
                                dialogCreate.modal('hide');
                            }
                        }else{
                            $('#no_razao_social').val('');
                            $('#ed_logradouro').val('');
                            $('#ed_numero_logradouro').val('');
                            $('#ed_complemento_logradouro').val('');
                            $('#ed_bairro_logradouro').val('');
                            $('#ed_cep_logradouro').val('');
                            $('#id_uf_logradouro').val('');
                            $('#no_representante').val('');
                            $('#nr_telefone').val('');
                            $('#ds_email').val('');                 
                            $.fn.setDisableContratada(false, retorno); 
                            dialogCreate.modal('hide');
                        }
                    });    
                }
            });

            $.fn.setDisableContratada = function(state, data) {
                $("#no_razao_social").prop("disabled", state);
                $("#ed_logradouro").prop("disabled", state);
                $("#ed_numero_logradouro").prop("disabled", state);     
                $("#ed_complemento_logradouro").prop("disabled", state);        
                $("#ed_bairro_logradouro").prop("disabled", state);     
                $("#ed_cep_logradouro").prop("disabled", state);        
                $("#bt_buscar_cep").prop("disabled", state);        
                $("#id_uf_logradouro").prop("disabled", state);     
                $("#id_municipio_logradouro").prop("disabled", state);      
                if (data.id_contratada){
                    $('#no_representante').prop("disabled", state);     
                    $('#nr_telefone').prop("disabled", state);      
                    $('#ds_email').prop("disabled", state);         
                }else{
                    $('#no_representante').prop("disabled", false);     
                    $('#nr_telefone').prop("disabled", false);      
                    $('#ds_email').prop("disabled", false);         
                }
            }

            $(document).on('change', '#id_uf_logradouro', function() {
                $.fn.busca_Municipios_UF("{{ url('portal/municipios/lista/') }}");
            });

            $(document).on('click','#bt_buscar_cep', function() {
                $.fn.busca_Campo_CEP("{{ url('portal/municipios/lista/') }}");
            });

            $(document).on('click','#btnFormSalvarAJAX', function() {
                $.fn.desabilitarTodosCampos();
            });

            $.fn.desabilitarTodosCampos = function() {
                $('#formulario input,select,textarea').each(function(){
                    $(this).prop("disabled", false);
                });
            }

            $('#modal-create').on('shown.bs.modal', function () {
                $.fn.verifica_acao();
            });

        });

    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>

@endsection