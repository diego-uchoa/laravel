<h2><strong>Relatório quantitativo de consultas a órgãos</strong></h2>
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
    <a href="{{ url($xlsFile) }}" dowload class="btn btn-sm btn-success">
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
                        <div class="row">
                            <div class="col-sm-6">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr><th colspan="4" style="background-color:#ddd; text-align:center;">Quantidade de consultas realizadas - Geral</th></tr>
                                        <th>Concluídas</th>
                                        <th>Pendentes</th>
                                        <th>Atrasadas</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $dados["MF"]["C"] }}</td>
                                            <td>{{ $dados["MF"]["P"] }}</td>
                                            <td>{{ $dados["MF"]["A"] }}</td>
                                            <td>{{ $dados["MF"]["C"] + $dados["MF"]["P"] + $dados["MF"]["A"] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                {!! $consultas["MF"]->render() !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr><th colspan="2" style="background-color:#ddd; text-align:center;">Consultas por órgão</th></tr>
                                        <th>Órgão</th>
                                        <th>Consultas realizadas</th>
                                    </thead>
                                    <tbody>
                                        @foreach($dados as $orgao => $dado)
                                            @if($orgao != "MF")
                                                <tr>
                                                    <td><a role="tab" data-toggle="tab" href="#{{ preg_replace('/[^A-Za-z0-9-]/', '', strtolower($orgao)) }}">{{ $orgao }}</a></td>
                                                    <td>{{ $dados[$orgao]["C"] + $dados[$orgao]["P"] + $dados[$orgao]["A"] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                {!! $orgaosConsultados->render() !!}
                            </div>
                        </div>
                    </div>
                    @foreach($dados as $orgao => $dado)
                        @if($orgao != "MF")
                            <div id="{{ preg_replace('/[^A-Za-z0-9-]/', '', strtolower($orgao)) }}" class="tab-pane">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr><th colspan="4" style="background-color:#ddd; text-align:center;">Quantidade de consultas realizadas - {{ $orgao }}</th></tr>
                                                <th>Concluídas</th>
                                                <th>Pendentes</th>
                                                <th>Atrasadas</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $dados[$orgao]["C"] }}</td>
                                                    <td>{{ $dados[$orgao]["P"] }}</td>
                                                    <td>{{ $dados[$orgao]["A"] }}</td>
                                                    <td>{{ $dados[$orgao]["C"] + $dados[$orgao]["P"] + $dados[$orgao]["A"] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! $consultas[$orgao]->render() !!}
                                    </div>
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