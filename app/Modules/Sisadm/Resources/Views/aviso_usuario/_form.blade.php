<div class="form-group">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('tx_aviso_usuario', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tipoAvisoSistema', 'Tipo Aviso Sistema:') !!}
    @if(isset($tipos))
    	{!! Form::select('id_tipo_aviso_usuario',$tipos, null, ['class'=>'chosen-select']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('nr_ordem', 'Ordem:') !!}
    {!! Form::text('nr_ordem', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('sistema', 'Sistema:') !!}    
    @if(isset($sistemas))
    	{!! Form::select('id_sistema', $sistemas, null, ['data-placeholder' => 'Selecione ...', 'class' => 'chosen-select form-control']) !!}
    @endif
</div>

<div class="form-group">
    {!! Form::label('usuario', 'Usuário:') !!}
    @if(isset($usuarios))
    	{!! Form::select('id_usuario',$usuarios, null, ['class'=>'chosen-select']) !!}
    @endif
</div>

{{ Form::hidden('sn_lido', 0) }}
{{ Form::hidden('dt_lido', '') }}


@section('script-end')

	@parent

	<script src="{{ URL::asset('js/select.js') }}"></script>
	
	<script type="text/javascript">
		//Método responsável por adicionar o estilo ao select
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.chosen_select();
        });
	</script>
@endsection