@extends('prisma::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('prisma::instituicoes.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Instituições
    @endsection

    <br>
    <br>

    <div class="table-container">
        @include('prisma::instituicoes._tabela')
    </div> 

@endsection


@section('script-end')
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
                          { "bSortable": true},{ "bSortable": true},{ "bSortable": true},{ "bSortable":true },{ "bSortable": true},
                          { "sWidth": "7%", "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_delete.js') }}"></script>
@endsection