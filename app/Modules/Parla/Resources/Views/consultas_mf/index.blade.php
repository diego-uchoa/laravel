@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::consultasMf.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Consultas ao MF
    @endsection

    @permission('parla::consultasMf.create')
        <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('parla::consultasMf.create')}}">
            <i class="ace-icon fa glyphicon-plus bigger-110"></i>
            Novo
        </a>
    @endpermission

    @permission('parla::consultasMf.relatorio')
        <a href="{{route('parla::consultasMf.relatorio')}}" class="btn btn-sm btn-success">
            <i class="ace-icon fa fa-bar-chart bigger-110"></i>
            Relatórios
        </a>
    @endpermission


    <br>
    <br>

    <div class="table-container">
        @include('parla::consultas_mf._tabela')
    </div> 

    <div class="formulario-container">
        @include('parla::consultas_mf._modal')
    </div> 

    <div class="formulario-container">
        @include('parla::consultas_mf.relatorios._modal')
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
                        order: [2,'desc'],
                        ajax: "{!! route('parla::consultasMf.list') !!}",
                        columns: [
                            { data: 'proposicao', name: 'proposicao', width: 'auto' },
                            { data: 'sg_orgao', name: 'sg_orgao', width: 'auto' },
                            { data: 'dt_envio', name: 'dt_envio', width: 'auto' },
                            { data: 'tx_tipo_consulta', name: 'tx_tipo_consulta', width: 'auto' },
                            { data: 'no_comissao', name: 'no_comissao', width: 'auto' },
                            { data: 'nr_prioritario', name: 'nr_prioritario', width: 'auto' },
                            { data: 'dt_retorno', name: 'dt_retorno', width: 'auto' },
                            { data: 'tx_tipo_posicao', name: 'tx_tipo_posicao', width: 'auto' },
                            { data: 'status', name: 'status', width: 'auto' },
                            { data: 'acoes', name: 'acoes', orderable: false, searchable: false, width: '7%'}
                        ],
                        drawCallback: function(settings) {
                            $("[data-rel=tooltip]").tooltip();
                        }
                    });
            };

            $(document).ready(function() {
                $.fn.dinamic_table();

            });

            $.fn.carregarFuncoes = function() {
                $.fn.chosen_select();
                $.fn.data_picker();
                $.fn.inicia_formulario();
                $.fn.busca_prioritario_proposicao();
            };
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
@endsection
