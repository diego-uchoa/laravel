@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::contratantes.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Contratante
    @endsection
    
    <a href="{{route('gescon::contratantes.create')}}" class="btn btn-sm btn-primary">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('gescon::contratantes._tabela')
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
                var oTable = $('#dynamic-table')
                    .DataTable({
                        language: {
                            url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}",
                        },
                        processing: true,
                        serverSide: true,
                        order: [2,'desc'],
                        ajax: "{!! route('gescon::contratantes.records') !!}",
                        columns: [
                            { data: 'sg_uasg', name: 'sg_uasg', width: '30%' },
                            { data: 'no_representante', name: 'no_representante', width: '50%' },
                            { data: 'operacoes', name: 'operacoes', orderable: false, searchable: false, width: '20%'}
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