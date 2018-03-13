<div class="row">
  <div class="col-xs-1 col-sm-1"></div>
    <div class="col-xs-12 col-sm-10">
        <div class="widget-box widget-color-grey">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title">DADOS DE GARANTIA E FISCAIS</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="row" style="padding-top: 4px; padding-bottom: 8px;">
                        <div class="col-xs-12 col-sm-3 div-column-border-right">
                            <strong>Modalidade</strong> <br>
                            {{ $contrato->modalidade_garantia }}
                        </div>
                        <div class="col-xs-12 col-sm-2 div-column-border-right">
                            <strong>Valor</strong> <br>
                            {{ $contrato->vl_garantia }}
                        </div>
                        <div class="col-xs-12 col-sm-2 div-column-border-right">
                            <strong>Percentual</strong> <br>
                            {{ $contrato->op_percentual_garantia }}
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <strong>Vencimento</strong> <br>
                            {{ $contrato->dt_vencimento_garantia }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="widget-box">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <h5 class="header smaller lighter grey">LISTA DE FISCAIS</h5>
                                            </div>
                                        </div>
                                        <div class="row div-row-border-bottom">
                                            <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                <strong>Tipo Fiscal</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 div-column-border-right">
                                                <strong>Titular</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-4 div-column-border-right">
                                                <strong>Substituto</strong> <br>
                                            </div>
                                            <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                <strong>Nº da Portaria</strong> <br>
                                            </div>
                                        </div>
                                        @if (isset($contrato))

                                            @foreach ($contrato->fiscais as $fiscal)

                                                <div class="row div-row-border-bottom">
                                                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                        {{ $fiscal->tipoFiscal() }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 div-column-border-right">
                                                        {{ $fiscal->fiscalTitular->no_fiscal }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 div-column-border-right">
                                                        {{ isset($fiscal->id_fiscal_substituto) ? $fiscal->fiscalSubstituto->no_fiscal : ' - ' }}
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                                                        {{ $fiscal->nr_portaria }}
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