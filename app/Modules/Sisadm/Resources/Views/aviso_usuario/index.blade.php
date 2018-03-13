@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::aviso_usuario.index') !!}

@endsection

@section('content')
    
    @section('page-header')
        Aviso Usuário
    @endsection
    
    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('sisadm::aviso_usuario.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('sisadm::aviso_usuario._tabela')
    </div> 

    <div class="formulario-container">
        @include('sisadm::aviso_usuario._modal')
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
                          { "bSortable": true },
                          { "bSortable": true },
                          { "bSortable": true },
                          { "bSortable": true },                       
                          { "bSortable": true },
                          { "bSortable": true },
                          { "bSortable": true },
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