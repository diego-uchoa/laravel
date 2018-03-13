<!-- Co Parlamentar Field -->
<div class="form-group">
    {!! Form::label('co_parlamentar', 'Co Parlamentar:') !!}
    {!! Form::number('co_parlamentar', null, ['class' => 'form-control']) !!}
</div>

<!-- No Parlamentar Field -->
<div class="form-group">
    {!! Form::label('no_parlamentar', 'No Parlamentar:') !!}
    {!! Form::text('no_parlamentar', null, ['class' => 'form-control']) !!}
</div>

<!-- No Civil Field -->
<div class="form-group">
    {!! Form::label('no_civil', 'No Civil:') !!}
    {!! Form::text('no_civil', null, ['class' => 'form-control']) !!}
</div>

<!-- In Sexo Field -->
<div class="form-group">
    {!! Form::label('in_sexo', 'In Sexo:') !!}
    {!! Form::text('in_sexo', null, ['class' => 'form-control']) !!}
</div>

<!-- In Cargo Field -->
<div class="form-group">
    {!! Form::label('in_cargo', 'In Cargo:') !!}
    {!! Form::text('in_cargo', null, ['class' => 'form-control']) !!}
</div>

<!-- Dt Nascimento Field -->
<div class="form-group">
    {!! Form::label('dt_nascimento', 'Dt Nascimento:') !!}
    {!! Form::date('dt_nascimento', null, ['class' => 'form-control']) !!}
</div>

<!-- Sg Uf Parlamentar Field -->
<div class="form-group">
    {!! Form::label('sg_uf_parlamentar', 'Sg Uf Parlamentar:') !!}
    {!! Form::text('sg_uf_parlamentar', null, ['class' => 'form-control']) !!}
</div>

<!-- Ds Email Field -->
<div class="form-group">
    {!! Form::label('ds_email', 'Ds Email:') !!}
    {!! Form::text('ds_email', null, ['class' => 'form-control']) !!}
</div>

<!-- Sn Exercicio Field -->
<div class="form-group">
    {!! Form::label('sn_exercicio', 'Sn Exercicio:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('sn_exercicio', false) !!}
        {!! Form::checkbox('sn_exercicio', '1', null) !!} 1
    </label>
</div>

<!-- Aq Foto Field -->
<div class="form-group">
    {!! Form::label('aq_foto', 'Aq Foto:') !!}
    {!! Form::text('aq_foto', null, ['class' => 'form-control']) !!}
</div>

<!-- Dt Cadastro Fim Field -->
<div class="form-group">
    {!! Form::label('dt_cadastro_fim', 'Dt Cadastro Fim:') !!}
    {!! Form::date('dt_cadastro_fim', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>