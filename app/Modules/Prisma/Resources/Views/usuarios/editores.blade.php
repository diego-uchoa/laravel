@extends('prisma::layouts.master')

@section('breadcrumbs-page')
    
    {!! Breadcrumbs::render('sisadm::usuarios.index') !!}

@endsection

@section('content')
    
    @section('page-header')
        Editores
    @endsection

    <a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('prisma::usuarios.create')}}">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>
    
    <br>
    <br>

    <div class="table-container">
        @include('prisma::usuarios._tabela')
    </div> 

    <div class="formulario-container">
        @include('prisma::usuarios._modal')
    </div>     

@endsection

@section('script-end')
    
    @parent

    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('js/select.js') }}"></script>

    <script type="text/javascript">

        $(function() {
            $.fn.dinamic_table = function() {
                var oTable = $('#dynamic-table').DataTable({
                    language: {
                      url: "{!! asset('modules/sismed/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('prisma::usuarios.records') !!}',
                    columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                        { data: 'no_usuario', name: 'no_usuario', width: '40%' },
                        { data: 'email', name: 'email', width: '20%' },
                        { data: 'instituicao', name: 'instituicao', width: '20%' },
                        { data: 'telefone', name: 'telefone', width: '10%' },
                        { data: 'operacoes', name: 'operacoes', width: '10%' }
                    ],
                });
            };

            $.fn.carregarFuncoes = function() {
                $.fn.select2_select('id_instituicao', "{{ url('prisma/instituicoes/list/') }}");
                $('.input-mask-cpf').mask('999.999.999-99');
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