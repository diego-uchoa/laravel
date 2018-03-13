

<div class="row">
    <div class="col-sm-2">
        <div class="form-group">    
            {!! Form::label('area', 'Área de Atendimento:') !!}
            {!! Form::select('in_area_atendimento',$areaAtendimento, null, ['class'=>'form-control','id'=>'in_area_atendimento']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('tipoAfastamento', 'Tipo de Afastamento:') !!}
            {!! Form::select('in_tipo_afastamento',$tipoAfastamento, null, ['class'=>'form-control','id'=>'in_tipo_afastamento']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('tipoPericia', 'Tipo de Perícia:') !!}
            {!! Form::select('in_tipo_pericia',$tipoPericia, null, ['class'=>'form-control','id'=>'in_tipo_pericia']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('crm', 'CRM:') !!}
            {!! Form::text('nr_crm', null, ['class'=>'form-control input-large', 'id'=>'nr_crm']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('medico', 'Médico:') !!}
            {!! Form::text('no_medico', null, ['class'=>'form-control input-xxlarge', 'id'=>'no_medico']) !!}
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('prazo', 'Prazo:') !!}
            {!! Form::text('te_prazo', null, ['class'=>'form-control input-large te_prazo', 'id'=>'te_prazo']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <label for="id-date-picker-1">Início</label>
        <div class="row">
            <div class="col-xs-8 col-sm-12">
                <div class="input-group">
                    <input class="form-control date-picker" class="dt_inicio_afastamento" id="dt_inicio_afastamento" type="text" data-date-format="dd/mm/yyyy" name='dt_inicio_afastamento' />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2">
        <label for="id-date-picker-1">Fim:</label>
        <div class="row">
            <div class="col-xs-8 col-sm-12">
                <div class="input-group">
                    <input class="form-control " id="dt_fim_afastamento" type="text" data-date-format="dd/mm/yyyy" name='dt_fim_afastamento'/>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
            
            {!! Form::label('Atestado:') !!}
            
            @yield('anexo')
            
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('situacao', 'Situação:') !!}
            {!! Form::select('in_situacao',$situacao, null, ['class'=>'form-control', 'id' => 'in_situacao', 'disabled']) !!}
            
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('tx_observacao', 'Observação:') !!}
            {!! Form::textarea('tx_observacao', null, ['class'=>'form-control', 'id'=>'tx_observacao', 'rows'=> 2]) !!}
        </div>
    </div>
</div>