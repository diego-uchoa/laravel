<h2><strong>Relatório analítico de consulta por órgão</strong></h2>
<h4>
    <strong>Período de análise:</strong>
    @if($dtInicio and $dtFim)
        {{ $dtInicio }} - {{ $dtFim }}
    @elseif($dtInicio and !($dtFim))
        A partir de {{ $dtInicio }}
    @elseif(!($dtInicio) and $dtFim)
        Até {{ $dtFim }}
    @else
        Todas as datas
    @endif
</h4>
<h4>
    <strong>Casa de tramitação:</strong>
    @if($sgCasaTramitacao == 'CD')
        Câmara dos Deputados
    @elseif($sgCasaTramitacao == 'SF')
        Senado Federal
    @elseif(!$sgCasaTramitacao)
        Todas as casas
    @endif
</h4>

<br>

@if(sizeof($dados) > 1)
    <a href="{{ url($pdfFile) }}" download class="btn btn-sm btn-danger">
        <i class="ace-icon fa fa-file-pdf-o bigger-110"></i>
        PDF
    </a>
    <a href="{{ url($xlsFile) }}" download class="btn btn-sm btn-success">
        <i class="ace-icon fa fa-file-excel-o bigger-110"></i>
        XLS
    </a>

    <br><br>

    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <i class="ace-icon fa fa-bar-chart"></i>
                Consultas ao MF
            </h5>

            <div class="widget-toolbar no-border">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#geral">Geral</a>
                    </li>
                    @foreach($dados as $orgao => $dado)
                        @if($orgao != "MF")
                            <li>
                                <a data-toggle="tab" href="#{{ preg_replace('/[^A-Za-z0-9-]/', '', strtolower($orgao)) }}">{{ $orgao }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <div class="tab-content">
                    <div id="geral" class="tab-pane in active">
                        <div class="col-md-7">
                            @if( sizeof($dados["MF"]["A"]) > 0)
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr><th colspan="5" style="color:#fff; background-color:#d15b47; text-align:center;">Consultas atrasadas</th></tr>
                                        <th>Órgão consultado</th>
                                        <th>Proposição</th>
                                        <th>Ementa</th>
                                        <th>Data de envio da consulta</th>
                                        <th>Data de retorno da consulta</th>
                                    </thead>
                                    <tbody>
                                        @foreach($dados["MF"]["A"] as $consultaAtrasada)
                                            <tr>
                                                <td style="width:5%">{{ $consultaAtrasada->orgao->sg_orgao }}</td>
                                                <td style="width:15%">{{ $consultaAtrasada->proposicao->sn_possui_revisora ? $consultaAtrasada->proposicao->origem.' - '.$consultaAtrasada->proposicao->revisora : $consultaAtrasada->proposicao->origem }}</td>
                                                <td style="width:60%">{{ $consultaAtrasada->proposicao->tx_ementa }}</td>
                                                <td style="width:10%">{{ $consultaAtrasada->dt_envio }}</td>
                                                <td style="width:10%">{{ $consultaAtrasada->dt_retorno }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            @if( sizeof($dados["MF"]["P"]) > 0)
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr><th colspan="5" style="color:#fff; background-color:#3a87ad; text-align:center;">Consultas pendentes</th></tr>
                                        <th>Órgão consultado</th>
                                        <th>Proposição</th>
                                        <th>Ementa</th>
                                        <th>Data de envio da consulta</th>
                                        <th>Data de retorno da consulta</th>
                                    </thead>
                                    <tbody>
                                        @foreach($dados["MF"]["P"] as $consultaPendente)
                                            <tr>
                                                <td style="width:5%">{{ $consultaPendente->orgao->sg_orgao }}</td>
                                                <td style="width:15%">{{ $consultaPendente->proposicao->sn_possui_revisora ? $consultaPendente->proposicao->origem.' - '.$consultaPendente->proposicao->revisora : $consultaPendente->proposicao->origem }}</td>
                                                <td style="width:60%">{{ $consultaPendente->proposicao->tx_ementa }}</td>
                                                <td style="width:10%">{{ $consultaPendente->dt_envio }}</td>
                                                <td style="width:10%">{{ $consultaPendente->dt_retorno }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            @if( sizeof($dados["MF"]["C"]) > 0)
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr><th colspan="5" style="color:#fff; background-color:#82af6f; text-align:center;">Consultas concluídas</th></tr>
                                        <th>Órgão consultado</th>
                                        <th>Proposição</th>
                                        <th>Ementa</th>
                                        <th>Data de envio da consulta</th>
                                        <th>Data de retorno da consulta</th>
                                    </thead>
                                    <tbody>
                                        @foreach($dados["MF"]["C"] as $consultaConcluida)
                                            <tr>
                                                <td style="width:5%">{{ $consultaConcluida->orgao->sg_orgao }}</td>
                                                <td style="width:15%">{{ $consultaConcluida->proposicao->sn_possui_revisora ? $consultaConcluida->proposicao->origem.' - '.$consultaConcluida->proposicao->revisora : $consultaConcluida->proposicao->origem }}</td>
                                                <td style="width:60%">{{ $consultaConcluida->proposicao->tx_ementa }}</td>
                                                <td style="width:10%">{{ $consultaConcluida->dt_envio }}</td>
                                                <td style="width:10%">{{ $consultaConcluida->dt_retorno }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="col-md-5">
                            {!! $consultas["MF"]->render() !!}
                        </div>
                    </div>
                    @foreach($dados as $orgao => $dado)
                        @if($orgao != "MF")
                            <div id="{{ preg_replace('/[^A-Za-z0-9-]/', '', strtolower($orgao)) }}" class="tab-pane">
                                <div class="col-md-7">
                                    @if( sizeof($dados[$orgao]["A"]) > 0)
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr><th colspan="4" style="color:#fff; background-color:#d15b47; text-align:center;">Consultas atrasadas</th></tr>
                                                <th>Proposição</th>
                                                <th>Ementa</th>
                                                <th>Data de envio da consulta</th>
                                                <th>Data de retorno da consulta</th>
                                            </thead>
                                            <tbody>
                                                @foreach($dados[$orgao]["A"] as $consultaAtrasada)
                                                    <tr>
                                                        <td style="width:15%">{{ $consultaAtrasada->proposicao->sn_possui_revisora ? $consultaAtrasada->proposicao->origem.' - '.$consultaAtrasada->proposicao->revisora : $consultaAtrasada->proposicao->origem }}</td>
                                                        <td style="width:65%">{{ $consultaAtrasada->proposicao->tx_ementa }}</td>
                                                        <td style="width:10%">{{ $consultaAtrasada->dt_envio }}</td>
                                                        <td style="width:10%">{{ $consultaAtrasada->dt_retorno }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    @if( sizeof($dados[$orgao]["P"]) > 0)
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr><th colspan="4" style="color:#fff; background-color:#3a87ad; text-align:center;">Consultas pendentes</th></tr>
                                                <th>Proposição</th>
                                                <th>Ementa</th>
                                                <th>Data de envio da consulta</th>
                                                <th>Data de retorno da consulta</th>
                                            </thead>
                                            <tbody>
                                                @foreach($dados[$orgao]["P"] as $consultaPendente)
                                                    <tr>
                                                        <td style="width:15%">{{ $consultaPendente->proposicao->sn_possui_revisora ? $consultaPendente->proposicao->origem.' - '.$consultaPendente->proposicao->revisora : $consultaPendente->proposicao->origem }}</td>
                                                        <td style="width:65%">{{ $consultaPendente->proposicao->tx_ementa }}</td>
                                                        <td style="width:10%">{{ $consultaPendente->dt_envio }}</td>
                                                        <td style="width:10%">{{ $consultaPendente->dt_retorno }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    @if( sizeof($dados[$orgao]["C"]) > 0)
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr><th colspan="4" style="color:#fff; background-color:#82af6f; text-align:center;">Consultas concluídas</th></tr>
                                                <th>Proposição</th>
                                                <th>Ementa</th>
                                                <th>Data de envio da consulta</th>
                                                <th>Data de retorno da consulta</th>
                                            </thead>
                                            <tbody>
                                                @foreach($dados[$orgao]["C"] as $consultaConcluida)
                                                    <tr>
                                                        <td style="width:15%">{{ $consultaConcluida->proposicao->sn_possui_revisora ? $consultaConcluida->proposicao->origem.' - '.$consultaConcluida->proposicao->revisora : $consultaConcluida->proposicao->origem }}</td>
                                                        <td style="width:65%">{{ $consultaConcluida->proposicao->tx_ementa }}</td>
                                                        <td style="width:10%">{{ $consultaConcluida->dt_envio }}</td>
                                                        <td style="width:10%">{{ $consultaConcluida->dt_retorno }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    {!! $consultas[$orgao]->render() !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        Não foram encontradas consultas enviadas no período informado.
        <br />
    </div>
@endif

<script type="text/javascript">
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = this.href.split('#');
        $('.nav a').filter('[href="#'+target[1]+'"]').tab('show');
    });
</script>