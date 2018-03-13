@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::proposicoes.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Proposições
    @endsection

    @permission('parla::proposicoes.create')
    <a href="#" data-url="{{route('parla::proposicoes.create')}}" class="btn btn-sm btn-primary insert">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>
    @endpermission

    <br>
    <br>

    <div class="table-container">
        @include('parla::proposicoes._tabela')
    </div> 

    <div class="formulario-container">
        
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
                        ajax: "{!! route('parla::proposicoes.list') !!}",
                        columns: [
                            { data: 'origem', name: 'origem', width: '9%' },
                            { data: 'revisora', name: 'revisora', width: '9%' },
                            { data: 'autoria', name: 'autoria', width: '15%' },
                            { data: 'ementa', name: 'ementa', width: '30%' },
                            { data: 'palavras_chave', name: 'palavras_chave', width: '30%' },
                            { data: 'acoes', name: 'acoes', orderable: false, searchable: false, width: '7%'}
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
    <script src="{{ asset('modules/parla/js/ajax_create.js') }}"></script>
@endsection