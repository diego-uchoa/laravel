@if (isset($contratos))
    <div class="col-sm-12">

        <div class="clearfix">
            <div class="pull-right tableTools-container">
                <div class="dt-buttons btn-overlap btn-group">
                    @if (count($contratos))
                        <a id="btnExportarXLS" href="{{ $arquivoXLS }}" class="dt-button buttons-csv buttons-html5 btn btn-white btn-light btn-bold" tabindex="0" data-rel="tooltip" data-original-title="Exportar para Planilha">
                            <span>
                                <i class="fa fa-file-excel-o bigger-110 orange"/>
                                <span class="hidden">Exportar para Planilha</span>
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="widget-box" id="widget-box-2">
            <div class="widget-header">
                <h5 class="widget-title smaller">
                    <i class="ace-icon fa fa-file-text-o"></i>
                    Resultado da Pesquisa
                </h5>
            </div>

            <div class="widget-body" style="max-height:604px; overflow-x:auto;">
                <div class="widget-main no-padding">
                    <table class="table table-striped table-bordered table-hover">
                        
                        @if (count($contratos))
                        
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th width="14%">Contrato - UASG</th>
                                    <th width="15%">Tipo de Contrato</th>
                                    <th width="20%">Modalidade</th>
                                    <th width="30%">Objeto</th>
                                    <th width="7%">Status</th>
                                    <th width="7%">Vencimento</th>
                                    <th width="7%">Visualizar</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($contratos as $contrato)
                                    <tr>
                                        <td>{{ $contrato->nr_contrato . ' - '. $contrato->co_uasg}}</td>
                                        <td>{{ $contrato->objeto_contrato}}</td>
                                        <td>{{ $contrato->modalidade->no_modalidade}}</td>
                                        <td>{{ str_limit($contrato->ds_objeto, 40)}}</td>
                                        <td>{{ $contrato->status_contrato }}</td>
                                        <td align="center">
                                            @if ($contrato->prazo_vencimento <= 30)
                                                <span class="label label-sm label-danger arrowed arrowed-right">{{ $contrato->dt_cessacao}}</span>
                                            @elseif ($contrato->prazo_vencimento > 30 && $contrato->prazo_vencimento <= 120)
                                                <span class="label label-sm label-warning arrowed arrowed-right">{{ $contrato->dt_cessacao}}</span>
                                            @else
                                                <span class="label label-sm label-success arrowed arrowed-right">{{ $contrato->dt_cessacao}}</span>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="{{ $contrato->rota_visualizacao_contrato }}" class='btn btn-xs btn-info' data-rel="tooltip" data-original-title="Visualizar Contrato">
                                                <i class='ace-icon fa fa-file-text-o'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        
                        @else
                            <tbody>

                                <tr>
                                    <td colspan="6">Não há contratos com as informações enviadas.</td>
                                </tr>

                            </tbody>

                        @endif

                    </table>
                </div>
            </div>
        </div>

    </div>
@endif  