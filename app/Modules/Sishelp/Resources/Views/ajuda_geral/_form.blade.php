<div class="form-group">
    {!! Form::label('geral', 'Visão Geral:') !!}
    {!! Form::textarea('tx_ajuda_geral', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('sistema', 'Sistema:') !!}
    {!! Form::select('id_sistema',$sistemas, null, ['class'=>'chosen-select']) !!}
</div>

{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>


@section('script-end')

	@parent

	<script src="{{ URL::asset('js/select.js') }}"></script>
	
	<script type="text/javascript">
	    
		$.fn.chosen_select();

	</script>
@endsection