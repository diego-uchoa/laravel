@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::orgaos.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Órgãos
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('sisadm::orgaos.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('sisadm::orgaos._tabela')
    </div> 

    <div class="formulario-container">
        @include('sisadm::orgaos._modal')
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
                          { "bSortable": false },
                          { "bSortable": false },
                          { "sWidth": "15%", "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });

            $.fn.carregarFuncoes = function() {
                //FAVOR INFORMAR AQUI AS FUNÇÕES A SEREM CARREGAS EX.: $.fn.data_picker();
            };
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    
@endsection