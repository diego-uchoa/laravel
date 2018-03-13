<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('no_operacao', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('descricao', 'Descrição:') !!}
    {!! Form::textarea('ds_operacao', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('sistema', 'Sistema:') !!}
    @if(isset($sistemas))
        {!! Form::select('id_sistema', $sistemas, null, ['class'=>'chosen-select']) !!}
    @endif
</div>

<div class="form-group">
    {{ Form::hidden('sn_favorita', 0) }}
    {!! Form::checkbox('sn_favorita', null, null, ['class'=>'ace']) !!} 
    {!! Form::label('sn_favorita', ' Favorita', ['class'=>'lbl']) !!}
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