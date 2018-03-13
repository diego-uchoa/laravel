

<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('tipoPericia', 'Tipo de Perícia:') !!}
            {!! Form::select('in_tipo_pericia',$tipoPericia, null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            {!! Form::label('prazo', 'Prazo:') !!}
            {!! Form::text('te_prazo', null, ['class'=>'form-control input-large te_prazo', 'id'=>'te_prazo_pericia']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <label for="id-date-picker-1">Início</label>
        <div class="row">
            <div class="col-xs-8 col-sm-12">
                <div class="input-group">
                    <input class="form-control date-picker" class="dt_inicio_afastamento" id="dt_inicio_afastamento_pericia" type="text" data-date-format="dd/mm/yyyy" name='dt_inicio_afastamento' />
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <label for="id-date-picker-1">Fim:</label>
        <div class="row">
            <div class="col-xs-8 col-sm-12">
                <div class="input-group">
                    <input class="form-control " id="dt_fim_afastamento_pericia" type="text" data-date-format="dd/mm/yyyy" name='dt_fim_afastamento'/>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    
    <div class="col-sm-6">
        <div class="form-group">
            
            {!! Form::label('Laudo:') !!}
            
            @yield('laudo')
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
        <label for="id-date-picker-1">Perícia:</label>
        <div class="row">
            <div class="col-xs-8 col-sm-12">
                <div class="input-group">
                    <input class="form-control date-picker" id="dt_pericia" type="text" data-date-format="dd/mm/yyyy" name='dt_pericia'/>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('situacao', 'Situação:') !!}
            {!! Form::select('in_situacao',$situacao, null, ['class'=>'form-control', 'id' => 'in_situacao_pericia']) !!}
            
        </div>
    </div>
</div>