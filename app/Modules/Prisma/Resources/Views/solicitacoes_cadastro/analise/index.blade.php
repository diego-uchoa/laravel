@extends('prisma::layouts.master')

@section('breadcrumbs-page')
    {!! Breadcrumbs::render('prisma::solicitacao.cadastro.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Solicitações de Cadastro
    @endsection

    <br>

    <div class="table-container">
        @include('prisma::solicitacoes_cadastro.analise._tabela')
    </div> 

@endsection


@section('script-end')
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

    <script type="text/javascript">
            jQuery(function($) {                
                $.fn.dinamic_table = function() {
                    var oTable = $('#dynamic-table').DataTable({
                        language: {
                          url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                        },
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('prisma::solicitacao.cadastro.list') !!}',
                        columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                            { data: 'nr_cnpj', name: 'nr_cnpj', width: '15%' },
                            { data: 'no_razao_social', name: 'no_razao_social', width: '20%' },
                            { data: 'no_relatorio', name: 'no_relatorio', width: '20%' },
                            { data: 'no_responsavel', name: 'no_responsavel', width: '20%' },
                            { data: 'in_situacao', name: 'in_situacao', width: '15%' },
                            { data: 'operacoes', name: 'operacoes', width: '10%' }
                        ],
                        drawCallback: function(settings) {
                            $("[data-rel=tooltip]").tooltip();
                        }
                    });
                };

                $(document).ready(function() {
                    $.fn.dinamic_table(); 
                });

            });

        </script>

    <script src="{{ asset('modules/sisadm/js/ajax_delete.js') }}"></script>
@endsection