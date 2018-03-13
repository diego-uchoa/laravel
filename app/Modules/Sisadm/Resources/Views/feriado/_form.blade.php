<div class="form-group">
    {!! Form::label('no_feriado', 'Nome:') !!}
    {!! Form::text('no_feriado', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
	<div class="input-group">
		{!! Form::label('dt_feriado', 'Data:') !!}
	</div>

	<div class="input-group">
	    {!! Form::text('dt_feriado', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy']) !!}
	    <span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
	    </span>
	</div>
</div>

<div class="form-group">
    {{ Form::hidden('sn_fim_semana', 0) }}
    {!! Form::checkbox('sn_fim_semana', null, null, ['class'=>'ace']) !!} 
    {!! Form::label('sn_fim_semana', ' Fim de Semana', ['class'=>'lbl']) !!}
</div>


@section('script-end')

	@parent

	<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

	<script type="text/javascript">
		$.fn.data_picker = function() {
	        //Métodos responsáveis pela funcionalidade de Data (Calendário)
            $('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			})
	    };

	    $.fn.data_picker();
	</script>
@endsection