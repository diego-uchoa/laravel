@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::tipos_situacao.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Tipos de Situação
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('parla::tipos_situacao.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('parla::tipos_situacao._tabela')
    </div> 

    <div class="formulario-container">
        @include('parla::tipos_situacao._modal')
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
                          { "bSortable": false },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },
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