@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::fiscais.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Fiscais
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('gescon::fiscais.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('gescon::fiscais._tabela')
    </div> 

    <div class="formulario-container">
        @include('gescon::fiscais._modal')
    </div> 

@endsection

@section('script-end')
    
    @parent

    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskTelefone.min.js') }}"></script>
    <script src="{{ URL::asset('modules/gescon/js/ajax_busca_dados_fiscal.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) {                
            $.fn.dinamic_table = function() {
                var oTable = $('#dynamic-table').DataTable({
                    language: {
                      url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('gescon::fiscais.records') !!}',
                    columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                        { data: 'nr_cpf', name: 'nr_cpf', width: '25%' },
                        { data: 'no_fiscal', name: 'no_fiscal', width: '45%' },
                        { data: 'nr_siape', name: 'nr_siape', width: '20%' },
                        { data: 'operacoes', name: 'operacoes', width: '10%' }
                    ],
                });
            };

            $(document).ready(function() {
                $('.input-mask-cpf').mask('999.999.999-99');
                $('.input-mask-numero-siape').mask('9999999');
                $.fn.mascaraTelefone();
                $.fn.dinamic_table(); 
            });

            $.fn.carregarFuncoes = function() {
                $('.input-mask-cpf').mask('999.999.999-99');
                $('.input-mask-numero-siape').mask('9999999');
                $.fn.mascaraTelefone();
            };


            $(document).on('click','#bt_buscar_cpf', function() {
                var campo_id = $('#id_fiscal');
                var campo = $('#nr_cpf');
                var v_url = "{{ url('gescon/fiscais/recuperar-dados-bd/') }}";
                $.fn.busca_fiscal_por_cpf(campo, v_url, function(retorno){
                    if (retorno != ""){
                        if ((retorno.st_cadastrado == 1)&&(campo_id.val() == "")){
                            dialogCreateFiscal = bootbox.dialog({
                                message: '<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw orange"></i>Fiscal já cadastrado. Favor verificar.</p>',
                                closeButton: true
                            });
                        }else{
                            $('#id_fiscal').val(retorno.id_fiscal);
                            $('#no_fiscal').val(retorno.no_fiscal);
                            $('#nr_siape').val(retorno.nr_siape);
                            $('#ds_email').val(retorno.ds_email);
                            $('#nr_telefone').val(retorno.nr_telefone);    
                        }
                    }else{
                        $('#id_fiscal').val('');
                        $('#no_fiscal').val('');
                        $('#nr_siape').val('');
                        $('#ds_email').val('');
                        $('#nr_telefone').val('');
                    }
                    if (retorno != ''){
                        if ((retorno.st_cadastrado == 1)&&(campo_id.val() == "")){
                            $.fn.setDisabled(false, retorno);    
                        }else{
                            $.fn.setDisabled(true, retorno);    
                        }
                    }else{
                        $.fn.setDisabled(false, retorno);    
                    }
                });

            });

            $.fn.setDisabled = function(state, data) {
                $("#no_fiscal").prop("readonly", state);
                $("#nr_siape").prop("readonly", state);     
                $("#ds_email").prop("readonly", state);
                $("#nr_telefone").prop("readonly", state);     
                if (data != ''){
                    if (data.id_fiscal == ""){
                        $("#ds_email").prop("readonly", false);     
                        $("#nr_telefone").prop("readonly", false);     
                    }
                }
            }

        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    
@endsection