<!-- Co Comissao Field -->
<div class="form-group">
    {!! Form::label('co_comissao', 'Co Comissao:') !!}
    {!! Form::number('co_comissao', null, ['class' => 'form-control']) !!}
</div>

<!-- Sg Casa Field -->
<div class="form-group">
    {!! Form::label('sg_casa', 'Sg Casa:') !!}
    {!! Form::text('sg_casa', null, ['class' => 'form-control']) !!}
</div>

<!-- Sg Comissao Field -->
<div class="form-group">
    {!! Form::label('sg_comissao', 'Sg Comissao:') !!}
    {!! Form::text('sg_comissao', null, ['class' => 'form-control']) !!}
</div>

<!-- No Comissao Field -->
<div class="form-group">
    {!! Form::label('no_comissao', 'No Comissao:') !!}
    {!! Form::textarea('no_comissao', null, ['class' => 'form-control']) !!}
</div>

<!-- In Tipo Field -->
<div class="form-group">
    {!! Form::label('in_tipo', 'In Tipo:') !!}
    {!! Form::text('in_tipo', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>