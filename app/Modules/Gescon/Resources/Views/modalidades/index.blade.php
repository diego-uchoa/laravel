@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::modalidades.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Modalidades
    @endsection

    <br>
    <br>

    <div class="table-container">
        @include('gescon::modalidades._tabela')
    </div> 

    <div class="formulario-container">
        @include('gescon::modalidades._modal')
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
                      url: "{!! asset('modules/sismed/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('gescon::modalidades.records') !!}',
                    columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                        { data: 'no_modalidade', name: 'no_modalidade', width: '100%' }
                    ],
                });
            };

            $(document).ready(function() {
                $.fn.dinamic_table(); 
            });

        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>

    <style type="text/css">
      
        .dataTables_processing {
            position: absolute;
            left: 50%;
            width: 100%;

            margin-left: -50%;
            margin-top: -25px;
            padding-top: 20px;
        }

        .form-group{
            margin-bottom: 5px;
        }

    </style>
    
@endsection