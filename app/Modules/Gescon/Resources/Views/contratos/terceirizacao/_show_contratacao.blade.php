<div class="row">
  <div class="col-xs-1 col-sm-1"></div>
    <div class="col-xs-12 col-sm-10">
        <div class="widget-box widget-color-grey">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title">DADOS DA CONTRATAÇÃO</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="row div-row-border-bottom">
                        <div class="col-xs-12 col-sm-12">
                            <strong>Descrição do Objeto</strong> <br>
                            {{ $contrato->ds_objeto }}
                        </div>
                    </div>
                    <div class="row div-row-border-bottom">
                        <div class="col-xs-12 col-sm-12">
                            <strong>Informações Complementares</strong> <br>
                            {{ $contrato->ds_informacao_complementar }}
                        </div>
                    </div>
                    <div class="row" style="padding-top: 4px; padding-bottom: 8px;">
                        <div class="col-xs-12 col-sm-4 div-column-border-right">
                            <strong>Valor Mensal</strong> <br>
                            {{ $contrato->vl_mensal }}
                        </div>
                        <div class="col-xs-12 col-sm-4 div-column-border-right">
                            <strong>Valor Anual</strong> <br>
                            {{ $contrato->vl_anual }}
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <strong>Valor Global</strong> <br>
                            {{ $contrato->vl_global }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <h5 class="header smaller lighter grey">ITENS DA CONTRATAÇÃO</h5>
                                            </div>
                                        </div>
                                        <div class="row div-row-border-bottom">
                                            <div class="col-xs-12 col-sm-1 div-column-border-right">
                                                <strong>Unidade</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                <strong>Edifício</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                <strong>Tipo</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                <strong>Quantidade</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                <strong>Valor</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                                <strong>Total</strong> <br>
                                            </div>
                                        </div>
                                        @if (isset($contrato))

                                            @php
                                              $var = 0;
                                            @endphp

                                            @foreach ($contrato->itensContratacao as $itemContratacao)

                                                <div class="row div-row-border-bottom">
                                                    <div class="col-xs-12 col-sm-1 div-column-border-right">
                                                        {{ $itemContratacao->orgao->sg_orgao }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 div-column-border-right">
                                                        {{ $itemContratacao->edificio->no_edificio }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                        {{ $itemContratacao->tipoItemContratacao->ds_tipo_item_contratacao }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                        {{ $itemContratacao->qt_item_contratacao }}
                                                        {{ $itemContratacao->unidadeMedidaItemContratacao->sg_unidade_medida_item_contratacao }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                        {{ GesconHelper::maskMoney($itemContratacao->vl_item_contratacao) }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2">
                                                        {{ GesconHelper::maskMoney($itemContratacao->vl_item_contratacao * $itemContratacao->qt_item_contratacao) }}
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