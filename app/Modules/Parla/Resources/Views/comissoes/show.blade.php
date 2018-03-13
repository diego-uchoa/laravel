@extends('parla::layouts.master')

@section('script-head')
    {!! Charts::assets() !!}

<script type="text/javascript">

</script>
@endsection

@section('breadcrumbs-page')

{!! Breadcrumbs::render('parla::comissoes.show', $comissao) !!}

@endsection

@section('content')
        
    @section('page-header')
      Composição 
      <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            {!! $comissao->sg_comissao.' - '.$comissao->no_comissao.' <strong>('.$comissao->no_casa.')</strong>' !!}
      </small>
    @endsection

        <br>
        
        <div class="row">
            <div class="col-lg-7">
                @include('parla::comissoes.composicao._estatisticas')
            </div>

            <div class="col-lg-5">
                @include('parla::comissoes.composicao._graficos')
            </div>
        </div>

        <br>
        <br>

        <div class="table-container" id="table-container-composicao-comissao">
            @include('parla::comissoes.composicao._tabela')
        </div>

        <br> 
        <br> 

        <div class="row center">
            <a href="{{ route('parla::comissoes.index') }}" class="center btn btn-sm btn-danger">
                <i class="ace-icon fa fa-gavel bigger-110"></i>
                <span class="bigger-110">Voltar para lista de Comissões</span>
            </a>
        </div>

        <div class="formulario-container">
            @include('parla::comissoes.composicao.posicionamento._modal')
        </div>

    @endsection


    @section('script-end')
        <script src="{{ asset('modules/parla/js/ajax_show.js') }}"></script>
        
        <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

        <script type="text/javascript">
            jQuery(function($) {                
                $.fn.dinamic_table = function() {
                    //inicializa dataTables
                    var oTable1 = $('#dynamic-table-composicao-comissao')
                        .dataTable({
                            bAutoWidth: false,
                            "aoColumns": [
                              { "bSortable": true },{ "bSortable": true },{ "bSortable": true },
                              { "sWidth": "15%", "bSortable": true }
                            ],
                            "aaSorting": []
                        });
                };

                $(document).ready(function() {
                    $.fn.dinamic_table(); 
                });
            });
        </script>
    @endsection