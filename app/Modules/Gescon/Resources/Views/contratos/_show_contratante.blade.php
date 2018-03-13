<div class="row">
	<div class="col-xs-1 col-sm-1"></div>
    <div class="col-xs-12 col-sm-10">
        <div class="widget-box widget-color-grey">
            <div class="widget-header widget-header-small">
                <h5 class="widget-title">DADOS DO CONTRATANTE</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                	<div class="row div-row-border-bottom">
             		   	<div class="col-xs-12 col-sm-2 div-column-border-right">
	                        <strong>Nº do Contrato</strong> <br>
							              {{ $contrato->nr_contrato }}
	                    </div>
             		   	<div class="col-xs-12 col-sm-2 div-column-border-right">
	                        <strong>UASG</strong> <br>
	                        {{ $contrato->co_uasg }}
	                    </div>
             		   	<div class="col-xs-12 col-sm-6 div-column-border-right">
	                        <strong>Contratante</strong> <br>
	                        {{ isset($contrato) ? $contrato->contratante->orgao->no_orgao : null }}
	                    </div>
	                </div>
                	<div class="row div-row-border-bottom">
             		   	<div class="col-xs-12 col-sm-2 div-column-border-right">
	                        <strong>CPF</strong> <br>
	                        {{ isset($contrato) ? $contrato->contratante->representante->nr_cpf_representante : null }}
	                    </div>
             		   	<div class="col-xs-12 col-sm-2 div-column-border-right">
	                        <strong>RG</strong> <br>
	                        {{ isset($contrato) ? $contrato->contratante->representante->nr_rg_representante : null }}
	                    </div>
             		   	<div class="col-xs-12 col-sm-4 div-column-border-right">
	                        <strong>Representante da Contratante</strong> <br>
							              {{ isset($contrato) ? $contrato->contratante->representante->no_representante : null }}
	                    </div>
             		   	<div class="col-xs-12 col-sm-4">
	                        <strong>Função</strong> <br>
	                        {{ isset($contrato) ? $contrato->contratante->representante->ds_funcao_representante : null }}
	                    </div>
	                </div>
                <div class="row div-row-border-bottom">
                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                        <strong>Tipo Contrato</strong> <br>
                        {{ $contrato->tipo_contrato }}
                    </div>
                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                        <strong>Nº Modalidade</strong> <br>
                        {!! MaskHelper::aplicaMascara($contrato->nr_modalidade, "####/####") !!}
                    </div>
                    <div class="col-xs-12 col-sm-4 div-column-border-right">
                        <strong>Modalidade</strong> <br>
                        {{ $contrato->modalidade->no_modalidade }}
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <strong>Ano</strong> <br>
                        {{ $contrato->nr_ano }}
                    </div>
                </div>   
                <div class="row" style="padding-top: 4px; padding-bottom: 4px;">
                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                        <strong>Nº Processo</strong> <br>
                        {{ MaskHelper::aplicaMascara($contrato->nr_processo, "#####.######/####-##") }}
                    </div>
                    <div class="col-xs-12 col-sm-2 div-column-border-right">
                        <strong>Nº Cronograma</strong> <br>
                        {!! $contrato->nr_cronograma !!}
                    </div>
                    <div class="col-xs-12 col-sm-4 div-column-border-right">
                        <strong>Arquivo Edital</strong> <br>
                        
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <strong>Arquivo Contrato</strong> <br>

                    </div>
                    <div class="col-xs-12 col-sm-4 div-column-border-right">
                        <strong>Arquivo Ata</strong> <br>
                        
                    </div>
                </div>  
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-1 col-sm-1"></div>
</div>