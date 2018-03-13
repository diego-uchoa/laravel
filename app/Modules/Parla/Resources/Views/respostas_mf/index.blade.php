@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::respostas_mf.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Respostas do MF
    @endsection
    

    @permission('parla::respostas_mf.create')
        <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('parla::respostas_mf.create')}}">
            <i class="ace-icon fa glyphicon-plus bigger-110"></i>
            Novo
        </a>
    @endpermission

    <br>
    <br>

    <div class="table-container">
        @include('parla::respostas_mf._tabela')
    </div> 

    <div class="formulario-container">
        @include('parla::respostas_mf._modal')
    </div> 

@endsection

@section('script-end')
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) {                
            $.fn.dinamic_table = function() {
                var oTable = $('#dynamic-table')
                    .DataTable({
                        language: {
                            url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}",
                        },
                        processing: true,
                        serverSide: true,
                        order: [1,'desc'],
                        ajax: "{!! route('parla::respostas_mf.list') !!}",
                        columns: [
                            { data: 'proposicao', name: 'proposicao', width: '12%' },
                            { data: 'dt_envio', name: 'dt_envio', width: '8%' },
                            { data: 'tx_tipo_posicao', name: 'tx_tipo_posicao', width: 'auto' },
                            { data: 'sg_orgao', name: 'sg_orgao', width: '8%' },
                            { data: 'documento', name: 'documento', width: 'auto' },
                            { data: 'tx_descricao', name: 'tx_descricao', width: '35%' },
                            { data: 'acoes', name: 'acoes', orderable: false, searchable: false, width: '7%'}
                        ],
                        drawCallback: function(settings) {
                            $("[data-rel=tooltip]").tooltip();
                        }
                    });
            };

            $.fn.file_campos = function() {        
                $('#arquivo-resposta').ace_file_input({
                  no_file:'Nenhum Arquivo ...',
                  btn_choose:'Selecione',
                  btn_change:'Alterar',
                  droppable:false,
                  onchange:null,
                  thumbnail:false  //| true | large
                  // whitelist:'pdf'
                  //blacklist:'exe|php'
                  //onchange:''
                  //
                });
            }

            $.fn.excluir_arquivo_documento = function() {
                $("#btn-excluir-documento").click(function(){
                    bootbox.confirm("Deseja realmente excluir o arquivo?", function(result){
                        if(result) {         
                            $('#row-arquivo').hide();
                            $('#row-arquivo-input').show();
                            $("input[name='arquivo_delete']").val('true');
                        }
                    });
                });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
                $.fn.file_campos();  
            });

            $.fn.carregarFuncoes = function() {
                $.fn.chosen_select();
                $.fn.data_picker();
                $.fn.file_campos();
                $.fn.excluir_arquivo_documento();
            };
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    
@endsection