@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::sistemas.index') !!}

@endsection


@section('content')
        
    @section('page-header')
        Sistemas
    @endsection
    
    @role('SISADM-Administrador')
        <a href="{{route('sisadm::sistemas.create')}}" class="btn btn-sm btn-primary">
            <i class="ace-icon fa glyphicon-plus bigger-110"></i>
            Novo
        </a>
    @endrole

    <br>
    <br>

    <div class="table-container">
        @include('sisadm::sistemas._tabela')
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
                          { "sWidth": "15%", "bSortable": true },
                          { "bSortable": false },
                          { "bSortable": true },
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
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_delete.js') }}"></script>
@endsection
