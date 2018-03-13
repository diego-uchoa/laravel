@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::sistemas.orgaos',$sistema) !!}

@endsection


@section('content')
        
    @section('page-header')
        Relacionar órgãos 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            {{$sistema->no_sistema}}
        </small>
    @endsection
    
    @role('SISADM-Administrador')
        <a href="#" data-url="{{route('sisadm::sistemas.orgaos.create',['id' => $sistema->id_sistema])}}" class="btn btn-sm btn-primary insert">
            <i class="ace-icon fa glyphicon-plus bigger-110"></i>
            Novo
        </a>
    @endrole

    <br>
    <br>

    <div class="table-container">
        @include('sisadm::sistemas.orgaos._tabela')
    </div> 

    <div class="formulario-container">
        @include('sisadm::sistemas.orgaos._modal')
    </div>

@endsection


@section('script-end')
    @parent
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('js/select.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) {                
            $.fn.dinamic_table = function() {
                //inicializa dataTables
                var oTable1 = $('#dynamic-table')
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                          { "sWidth": "10%", "bSortable": true },
                          { "bSortable": true },
                          { "sWidth": "10%", "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $.fn.carregarFuncoes = function() {
                $.fn.select2_select('id_orgao', "{{ url('sisadm/orgao/list/') }}");
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
@endsection
