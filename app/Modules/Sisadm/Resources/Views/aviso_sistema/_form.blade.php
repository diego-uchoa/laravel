<div class="form-group">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('tx_aviso_sistema', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tipoAvisoSistema', 'Tipo Aviso Sistema:') !!}
    @if(isset($tipos))
    	{!! Form::select('id_tipo_aviso_sistema',$tipos, null, ['class'=>'chosen-select form-control']) !!}
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
    {{ Form::hidden('sn_destaque', 0) }}
    {!! Form::checkbox('sn_destaque', null, null, ['class'=>'ace']) !!} 
    {!! Form::label('sn_destaque', ' Destaque', ['class'=>'lbl']) !!}
</div>


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