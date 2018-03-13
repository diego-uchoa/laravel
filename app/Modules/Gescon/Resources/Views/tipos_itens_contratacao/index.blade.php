@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::tipos_itens_contratacao.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Objetos de Contratação
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('gescon::tipos_itens_contratacao.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('gescon::tipos_itens_contratacao._tabela')
    </div> 

    <div class="formulario-container">
        @include('gescon::tipos_itens_contratacao._modal')
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
                var oTable = $('#dynamic-table').DataTable({
                    language: {
                      url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('gescon::tipos_itens_contratacao.records') !!}',
                    columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                        { data: 'in_objeto', name: 'in_objeto', width: '35%' },
                        { data: 'ds_tipo_item_contratacao', name: 'ds_tipo_item_contratacao', width: '55%' },
                        { data: 'operacoes', name: 'operacoes', width: '10%' }
                    ],
                });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    
@endsection