@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::parlamentares.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Parlamentares
    @endsection
    


    <br>
    <br>

    <div class="table-container">
        @include('parla::parlamentares._tabela')
    </div> 

@endsection


@section('script-end')
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
                        order: [0,'asc'],
                        processing: true,
                        serverSide: true,
                        ajax: "{!! route('parla::parlamentares.list') !!}",
                        columns: [
                            { data: 'no_parlamentar', name: 'no_parlamentar', width: 'auto' },
                            { data: 'in_cargo', name: 'in_cargo', width: 'auto' },
                            { data: 'sg_uf_parlamentar', name: 'sg_uf_parlamentar', width: 'auto' },
                            { data: 'sn_exercicio', name: 'sn_exercicio', width: 'auto' },
                            { data: 'posicionamento', name: 'posicionamento', width: 'auto' },
                            { data: 'acoes', name: 'acoes', orderable: false, searchable: false, width: 'auto'}
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