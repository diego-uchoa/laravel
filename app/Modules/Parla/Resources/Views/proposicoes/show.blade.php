@extends('parla::layouts.master')

@section('breadcrumbs-page')

{!! Breadcrumbs::render('parla::proposicoes.show', $proposicao) !!}

@endsection

@section('content')

@section('page-header')
Detalhes da proposição 
<small>
    <i class="ace-icon fa fa-angle-double-right"></i>
    {{ $proposicao->sn_possui_revisora ? $proposicao->origem.' - '.$proposicao->revisora : $proposicao->origem }}
</small>
@endsection

<div class="row">
    <div class="col-xs-12">        
        <div id="proposicao" class="user-profile">
            <div class="tabbable">
                <ul class="nav nav-tabs padding-18">
                    <li class="active">
                        <a data-toggle="tab" href="#dados_proposicao">
                            <i class="green ace-icon fa fa-file-text-o bigger-120"></i>
                            Dados da Proposição
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#tramitacoes">
                            <i class="orange ace-icon fa fa-road bigger-120"></i>
                            Tramitações 
                            <span class="badge">{{ sizeof($proposicao->tramitacoes) }}</span>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#emendas">
                            <i class="blue ace-icon fa fa-plus bigger-120"></i>
                            Emendas
                            <span class="badge">{{ sizeof($proposicao->emendas) }}</span>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#substitutivos">
                            <i class="pink ace-icon fa fa-retweet bigger-120"></i>
                            Substitutivos
                            <span class="badge">{{ sizeof($proposicao->substitutivos) }}</span>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#apensados">
                            <i class="red ace-icon fa fa-paperclip bigger-120"></i>
                            Apensados
                            <span class="badge">{{ sizeof($proposicao->apensados) }}</span>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#materias_relacionadas">
                            <i class="grey ace-icon fa fa-share-alt bigger-120"></i>
                            Matérias relacionadas
                            <span class="badge">{{ sizeof($proposicao->materias_relacionadas) }}</span>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#consultas">
                            <i class="purple ace-icon fa fa-question-circle bigger-120"></i>
                            Consultas ao MF
                            <span class="badge">{{ sizeof($proposicao->consultas) }}</span>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#respostas">
                            <i class="green ace-icon fa fa-send bigger-120"></i>
                            Respostas do MF
                            <span class="badge">{{ sizeof($proposicao->respostas) }}</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content no-border padding-24">
                    <div id="dados_proposicao" class="tab-pane in active">
                        @include('parla::proposicoes.show._dados_proposicao')
                    </div>

                    <div id="tramitacoes" class="tab-pane">
                        @include('parla::proposicoes.show._tramitacoes')
                    </div>

                    <div id="emendas" class="tab-pane">
                        @include('parla::proposicoes.show._emendas')
                    </div>

                    <div id="substitutivos" class="tab-pane">
                        @include('parla::proposicoes.show._substitutivos')
                    </div>

                    <div id="materias_relacionadas" class="tab-pane">
                        @include('parla::proposicoes.show._materias_relacionadas')
                    </div>

                    <div id="apensados" class="tab-pane">
                        @include('parla::proposicoes.show._apensados')
                    </div>

                    <div id="consultas" class="tab-pane">
                        @include('parla::proposicoes.show._consultas')
                    </div>

                    <div id="respostas" class="tab-pane">
                        @include('parla::proposicoes.show._respostas')
                    </div>
                </div>                        
            </div>
        </div>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row center">
    <a href="{{ route('parla::proposicoes.index') }}" class="center btn btn-sm btn-danger">
        <i class="ace-icon fa fa-files-o bigger-110"></i>
        <span class="bigger-110">Voltar para lista de Proposições</span>
    </a>
</div>

<div class="formulario-container">
  @include('parla::proposicoes.observacoes._modal')
</div> 

<div class="formulario-container">
  @include('parla::proposicoes.prioritario._modal')
</div> 

<div class="formulario-container">
    @include('parla::consultas_mf._modal')
</div>

<div class="formulario-container">
    @include('parla::respostas_mf._modal')
</div>

@endsection

@section('script-end')
    <script src="{{ asset('modules/parla/js/ajax_show.js') }}"></script>

    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.matchHeight.js') }}"></script>

    <script type="text/javascript">
        jQuery(function($) { 
            $.fn.dinamic_table_consultas = function() {
                //inicializa dataTables
                var oTable1 = $('#dynamic-table-consultas')
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                          { "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },
                          { "sWidth": "15%", "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $.fn.dinamic_table_respostas = function() {
                //inicializa dataTables
                var oTable2 = $('#dynamic-table-respostas')
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                          { "bSortable": true },{ "bSortable": true },{ "sWidth": "8%", "bSortable": true },{ "bSortable": true },{ "sWidth": "35%","bSortable": true },
                          { "sWidth": "7%", "bSortable": false }
                        ],
                        "aaSorting": []
                    });
            };

            $.fn.file_campos = function() {        
                $('#arquivo-resposta').ace_file_input({
                  no_file:'Nenhum Arquivo ...',
                  btn_choose:'Selecione',
                  btn_change:'Alterar',
                  droppable:false,
                  onchange:null,
                  thumbnail:false  //| true | large
                });
            }

            $.fn.excluir_arquivo_documento = function() {
                $("#btn-excluir-documento").click(function(){
                    bootbox.confirm("Deseja realmente excluir o arquivo?", function(result){
                        if(result) {         
                            $('#row-arquivo').hide();
                            $('#row-arquivo-input').show();
                            $("input[name='arquivo_delete']").val('true');
                        }
                    });
                });
            };

            $(document).ready(function() {
                $.fn.dinamic_table_consultas();
                $.fn.dinamic_table_respostas();
                $.fn.file_campos();
                $('.casa-row').matchHeight();
                $('.codigo-row').matchHeight();
                $('.terminativo-row').matchHeight();
                $('.regime-row').matchHeight();
                $('.situacao-row').matchHeight();
                $('.link-row').matchHeight();
            });

            $.fn.carregarFuncoes = function() {
                $.fn.chosen_select();
                $.fn.data_picker();
                $.fn.file_campos();
                $.fn.excluir_arquivo_documento();
                $.fn.busca_prioritario_proposicao();
            };
        });
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
@endsection