<!-- Sg Orgao Field -->
<div class="form-group">
    {!! Form::label('sg_orgao', 'Sg Orgao:') !!}
    {!! Form::text('sg_orgao', null, ['class' => 'form-control']) !!}
</div>

<!-- No Orgao Field -->
<div class="form-group">
    {!! Form::label('no_orgao', 'No Orgao:') !!}
    {!! Form::text('no_orgao', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Municipio Field -->
<div class="form-group">
    {!! Form::label('id_municipio', 'Id Municipio:') !!}
    {!! Form::number('id_municipio', null, ['class' => 'form-control']) !!}
</div>

<!-- Co Uorg Field -->
<div class="form-group">
    {!! Form::label('co_uorg', 'Co Uorg:') !!}
    {!! Form::text('co_uorg', null, ['class' => 'form-control']) !!}
</div>

<!-- Sn Oficial Field -->
<div class="form-group">
    {!! Form::label('sn_oficial', 'Sn Oficial:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('sn_oficial', false) !!}
        {!! Form::checkbox('sn_oficial', '1', null) !!} 1
    </label>
</div>

<!-- Nr Ordem Field -->
<div class="form-group">
    {!! Form::label('nr_ordem', 'Nr Ordem:') !!}
    {!! Form::number('nr_ordem', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Orgao Id Field -->
<div class="form-group">
    {!! Form::label('id_orgao_id', 'Id Orgao Id:') !!}
    {!! Form::number('id_orgao_id', null, ['class' => 'form-control']) !!}
</div>

@section('script-end')

	@parent

	<script src="{{ URL::asset('js/select.js') }}"></script>

	<script type="text/javascript">
	    
	    //FAVOR ADICIONAR AQUI AS FUNÇÕES ESPECÍFICAS PARA CADA FORMULÁRIO, A FUNÇÃO COMENTADA ABAIXO É RELACIONADA AO SELECT.
	    /*
	    //Método responsável por adicionar o estilo ao select
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.chosen_select();
        });
        */
	</script>
@endsection
