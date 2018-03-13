<div class="col-xs-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('area', 'Área:') !!}   
        {!! Form::select('id_area',$areasLists, null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="col-xs-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('nome', 'Nome:') !!}
        {!! Form::text('no_sistema', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="col-xs-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('descricao', 'Descrição:') !!}
        {!! Form::textarea('ds_sistema', null, ['class'=>'form-control limited', 'maxlength'=>'50', 'style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 70px']) !!}
    </div>
</div>

<div class="col-xs-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('tx_beneficio', 'Benefício:') !!}
        {!! Form::textarea('tx_beneficio', null, ['class'=>'autosize-transition form-control', 'style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 70px']) !!}
    </div>
</div>

<div class="col-xs-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('tx_publico', 'Público:') !!}
        {!! Form::textarea('tx_publico', null, ['class'=>'autosize-transition form-control', 'style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 70px']) !!}
    </div>
</div>

<div class="col-xs-12 col-sm-12">
    <div class="form-group">
        {!! Form::label('co_esquema', 'Código Esquema:') !!}
        {!! Form::text('co_esquema', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="col-xs-6 col-sm-6">
    <div class="form-group">
        {!! Form::label('no_responsavel', 'Nome(s) Responponsável(is):') !!}
        {!! Form::textarea('no_responsavel', null, ['class'=>'autosize-transition form-control', 'style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px']) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6">
    <div class="form-group">
        {!! Form::label('tx_email_responsavel', 'Email(s) Responsável(is):') !!}
        {!! Form::textarea('tx_email_responsavel', null, ['class'=>'autosize-transition form-control', 'style'=>'overflow: hidden; word-wrap: break-word; resize: horizontal; height: 90px']) !!}
    </div>
</div>

<div class="col-xs-6 col-sm-6">
    <div class="form-group">
        {{ Form::hidden('sn_tela_inicial', 0) }}
        {!! Form::checkbox('sn_tela_inicial', null, null, ['class'=>'ace']) !!} 
        {!! Form::label('sn_tela_inicial', ' Tela Inicial', ['class'=>'lbl']) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6">
    <div class="form-group">
        {{ Form::hidden('sn_ativo', 0) }}
        {!! Form::checkbox('sn_ativo', null, null, ['class'=>'ace']) !!} 
        {!! Form::label('sn_ativo', ' Ativo', ['class'=>'lbl']) !!}
    </div>
</div>

{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>

