<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Tipo de Contrato:</label>
    <div class="col-xs-4 col-sm-4">
        {!! Form::select('tp_contrato', $listaObjetoContrato, null, ['class' => 'form-control', 'id' => 'tp_contrato', 'placeholder' => 'Selecione um tipo...']) !!}
    </div>
    <label class="col-sm-2 control-label no-padding-right">Vencimento em:</label>
    <div class="col-xs-3 col-sm-3">
        {!! Form::select('cb_vencimento', ['' => 'Selecione um vencimento...', '15' => '15 dias', '30' => '30 dias', '60' => '60 dias', '120' => '120 dias', '180' => '180 dias'], null, ['class' => 'form-control', 'id' => 'cb_vencimento']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Nº Contrato:</label>
    <div class="col-sm-4">
        {!! Form::text('nr_contrato', null, ['class' => 'input-sm input-mask-numero-contrato', 'id' => 'nr_contrato']) !!}
    </div>
    <label class="col-sm-2 control-label no-padding-right">Nº Processo:</label>
    <div class="col-sm-4">
        {!! Form::text('nr_processo', null, ['class' => 'input-sm input-mask-numero-processo', 'id' => 'nr_processo']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Unidade Contratante:</label>
    <div class="col-sm-4">
        {!! Form::select('cb_contratante[]', $listaContratante, null, ['class' => 'chosen-select form-control tag-input-style', 'id' => 'cb_contratante[]', 'multiple' => '', 'data-placeholder' => 'Selecione o Contratante...']) !!}
    </div>
    <label class="col-sm-2 control-label no-padding-right">Contratada:</label>
    <div class="col-sm-4">
        {!! Form::select('cb_contratada[]', $listaContratada, null, ['class' => 'chosen-select form-control tag-input-style', 'id' => 'cb_contratada[]', 'multiple' => '', 'data-placeholder' => 'Selecione a Contratada...']) !!}
    </div>
</div>           

<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Unidade Atendida:</label>
    <div class="col-sm-4">
        {!! Form::select('cb_orgao[]', $listaOrgaos, null, ['class' => 'chosen-select form-control tag-input-style', 'id' => 'cb_orgao[]', 'multiple' => '', 'data-placeholder' => 'Selecione a Unidade Atendida...']) !!}
    </div>
    <label class="col-sm-2 control-label no-padding-right">Edifício:</label>
    <div class="col-sm-4">
        {!! Form::select('cb_edificio[]', $listaEdificios, null, ['class' => 'chosen-select form-control tag-input-style', 'id' => 'cb_edificio[]', 'multiple' => '', 'data-placeholder' => 'Selecione o Edifício...']) !!}
    </div>
</div>           

<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Fiscal Titular:</label>
    <div class="col-sm-4">
        {!! Form::select('cb_fiscal_titular[]', $listaFiscais, null, ['class' => 'chosen-select form-control tag-input-style', 'id' => 'cb_fiscal_titular[]', 'multiple' => '', 'data-placeholder' => 'Selecione o Fiscal Titular...']) !!}
    </div>
    <label class="col-sm-2 control-label no-padding-right">Fiscal Substituto:</label>
    <div class="col-sm-4">
        {!! Form::select('cb_fiscal_substituto[]', $listaFiscais, null, ['class' => 'chosen-select form-control tag-input-style', 'id' => 'cb_fiscal_substituto[]', 'multiple' => '', 'data-placeholder' => 'Selecione o Fiscal Substituto...']) !!}
    </div>
</div>           

<!-- <div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Valor Global:</label>
    <div class="col-sm-4">
        {!! Form::text('vl_global', null, ['class' => 'input-sm input-mask-money', 'id' => 'vl_global']) !!}
    </div>
</div> -->

<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Data Assinatura:</label>
    <div class="col-sm-2">
        <div class="input-group">
            {!! Form::text('dt_assinatura', null, ['class' => 'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_assinatura']) !!}
            <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
            </span>
        </div>
    </div>
    <div class="col-sm-2"></div>
    <label class="col-sm-2 control-label no-padding-right">Data Publicação:</label>
    <div class="col-sm-2">
        <div class="input-group">
            {!! Form::text('dt_publicacao', null, ['class' => 'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_publicacao']) !!}
            <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
            </span>
        </div>
    </div>
</div>     

<div class="form-group">
    <label class="col-sm-2 control-label no-padding-right">Situação:</label>
    <div class="col-xs-4 col-sm-4">
        {!! Form::select('in_status_contrato', $listaStatusContrato, null, ['class' => 'form-control', 'id' => 'in_status_contrato', 'placeholder' => 'Selecione...']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
        <button type="button" class="btn btn-sm btn-primary pull-right" id="btnFormAJAX" name="btnFormAJAX">
            <i class="ace-icon fa fa-search bigger-110"></i>Pesquisar
        </button>
    </div>
</div>