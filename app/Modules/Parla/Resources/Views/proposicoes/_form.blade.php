<div class="form-group">
    {!! Form::label('sg_tipo', 'Tipo:') !!}
    {!! Form::select('sg_tipo', $listaTiposProposicao, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('nr_numero', 'Número:') !!}
    {!! Form::number('nr_numero', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('an_ano', 'Ano:') !!}
    {!! Form::number('an_ano', null, ['class' => 'form-control']) !!}
</div>