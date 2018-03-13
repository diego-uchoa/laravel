@extends('prisma::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('prisma::instituicoes_responsavel_previsao.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Instituições Responsáveis pelas Previsões
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('prisma::instituicoes_responsavel_previsao.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('prisma::instituicoes_responsavel_previsao._tabela')
    </div> 

    <div class="formulario-container">
        @include('prisma::instituicoes_responsavel_previsao._modal')
    </div> 

@endsection

@section('script-end')
    
    @parent

    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) {                
            $.fn.dinamic_table = function() {
                //inicializa dataTables
                var oTable1 = $('#dynamic-table')
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                          { "bSortable": true },{ "bSortable": true },
                          { "sWidth": "15%", "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });

            $.fn.carregarFuncoes = function() {
                $.fn.inputMaiusculo();
            };
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    
@endsection