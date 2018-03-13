<div class="row">
  <div class="col-xs-1 col-sm-1"></div>
    <div class="col-xs-12 col-sm-10">
        <div class="widget-box widget-color-grey">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title">DADOS DAS DATA, PROCESSO DE PAGAMENTO E VARIAÇÃO</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="row div-row-border-bottom">
                        <div class="col-xs-12 col-sm-2 div-column-border-right">
                            <strong>Assinatura</strong> <br>
                            {{ $contrato->dt_assinatura }}
                        </div>
                        <div class="col-xs-12 col-sm-3 div-column-border-right">
                            <strong>Publicação do Contrato</strong> <br>
                            {{ $contrato->dt_publicacao }}
                        </div>
                        <div class="col-xs-12 col-sm-3 div-column-border-right">
                            <strong>Início Prest. de Serviço</strong> <br>
                            {{ $contrato->dt_inicio_servico }}
                        </div>
                        <div class="col-xs-12 col-sm-2 div-column-border-right">
                            <strong>Cessação</strong> <br>
                            {{ $contrato->dt_cessacao }}
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <strong>Prorrogação</strong> <br>
                            {{ $contrato->dt_prorrogacao }}
                        </div>
                    </div>
                    <div class="row" style="padding-top: 4px; padding-bottom: 8px;">
                        <div class="col-xs-12 col-sm-5 div-column-border-right">
                            <strong>Variação</strong> <br>
                            {{ $contrato->tipo_variacao }}
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <strong>Índice de Variação:</strong> <br>
                            {{ $contrato->dt_publicacao }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <h5 class="header smaller lighter grey">PROCESSOS DE PAGAMENTOS</h5>
                                            </div>
                                        </div>
                                        <div class="row div-row-border-bottom">
                                            <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                <strong>Nota de Empenho</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                <strong>Tipo de Empenho</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                <strong>Plano Interno</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                <strong>Elemento de Despesa</strong> <br>
                                            </div>
                                        </div>
                                        @if (isset($contrato))

                                            @foreach ($contrato->processosPagamento as $processoPagamento)

                                                <div class="row div-row-border-bottom">
                                                    <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                        {{ $processoPagamento->nr_nota_empenho }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                        {{ $processoPagamento->tipoEmpenho() }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                        {{ $processoPagamento->nr_plano_interno }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                        {{ $processoPagamento->nr_elemento_despesa }}
                                                    </div>
                                                </div>  

                                            @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-1 col-sm-1"></div>
</div>