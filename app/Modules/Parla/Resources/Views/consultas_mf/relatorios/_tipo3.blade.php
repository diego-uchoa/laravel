<h2><strong>Relatório por proposição legislativa</strong></h2>
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

@if(sizeof($dados) > 0)
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
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <p>Total de proposições consultadas: <strong>{{ count($dados) }}</strong></p>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <th>Proposição</th>
                        <th>Ementa</th>
                        <th>Órgãos consultados</th>
                    </thead>
                    <tbody>
                        @foreach($dados as $dado)
                            <tr>
                                <td style="width:15%">{{ $dado['Proposição'] }}</td>
                                <td style="width:70%">{{ $dado['Ementa'] }}</td>
                                <td style="width:15%">{{ $dado['Órgãos'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
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