<div class="row">
  <div class="col-xs-1 col-sm-1"></div>
    <div class="col-xs-12 col-sm-10">
        <div class="widget-box widget-color-grey">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title">OUTRAS INFORMAÇÕES</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="row div-row-border-bottom">
                        <div class="col-xs-12 col-sm-4 div-column-border-right">
                            <strong>Campo</strong> <br>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                            <strong>Descrição</strong> <br>
                        </div>
                    </div>
                    @if (isset($contrato))

                        @foreach ($contrato->outrasInformacoes as $outraInformacao)

                            <div class="row div-row-border-bottom">
                                <div class="col-xs-12 col-sm-4 div-column-border-right">
                                    {{ $outraInformacao->id_campo_informacao_adicional }}
                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    {{ $outraInformacao->ds_campo_informacao_adicional }}
                                </div>
                            </div>  

                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-1 col-sm-1"></div>
</div>