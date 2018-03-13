@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
    
    {!! Breadcrumbs::render('sisadm::operacoes.index') !!}

@endsection

@section('content')
    
    @section('page-header')
        Operações
    @endsection

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('sisadm::operacoes.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>
    
    <div class="table-container">
        @include('sisadm::operacoes._tabela')
    </div> 

    <div class="formulario-container">
        @include('sisadm::operacoes._modal')
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
                          { "bSortable": false },
                          { "bSortable": false },
                          null,
                          { "bSortable": false },
                          { "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });

            $.fn.carregarFuncoes = function() {
                $.fn.chosen_select();
            };
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
@endsection