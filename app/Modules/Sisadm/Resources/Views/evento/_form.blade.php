<div class="form-group">
    {!! Form::label('no_evento', 'Nome:') !!}
    {!! Form::text('no_evento', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('ds_evento', 'Descrição:') !!}
    {!! Form::text('ds_evento', null, ['class'=>'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('datahora', 'Data do Evento:') !!}
    @if(isset($datahora))
    	{!! Form::text('datahora', $datahora, ['class'=>'form-control']) !!}
    @endif
</div>

<div class="form-group">
    {{ Form::hidden('sn_todo_dia', 0) }}
    {!! Form::checkbox('sn_todo_dia', null, null, ['class'=>'ace']) !!} 
    {!! Form::label('sn_todo_dia', ' Todo Dia', ['class'=>'lbl']) !!}
</div>


@section('css')
	
	@parent
	<link href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">  
	<link href="{{ asset('assets/css/fullcalendar.min.css') }}" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

@stop


@section('script-end')

	@parent

	<script src="{{ asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/fullcalendar.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/locale-all.js') }}" type="text/javascript"></script>
	<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js" type="text/javascript"></script>
	
	<script type="text/javascript">

	$(function () {

	    $.fn.data_hora = function() {
		    $("#datahora").daterangepicker({
		               "minDate": moment("{!! Carbon\Carbon::now()->subDay()->format('Y-m-d G') !!}"),
		               "timePicker": true,
		               "timePicker24Hour": true,
		               "timePickerIncrement": 15,
		               "autoApply": true,            
		               "locale": {
		                   "format": "DD/MM/YYYY HH:mm:ss",
		                   "separator": " - ",
		                   "applyLabel": "Aplicar",
		                   "cancelLabel": "Cancelar",
		                   "fromLabel": "De",
		                   "toLabel": "Para",                        
		                   "daysOfWeek": [
		                       "Dom",
		                       "Seg",
		                       "Ter",
		                       "Qua",
		                       "Qui",
		                       "Sex",
		                       "Sab"
		                   ],
		                   "monthNames": [
		                       "Janeiro",
		                       "Fevereiro",
		                       "Março",
		                       "Abril",
		                       "Maio",
		                       "Junho",
		                       "Julho",
		                       "Agosto",
		                       "Setembro",
		                       "Outubro",
		                       "Novembro",
		                       "Dezembro"
		                   ],
		                   "firstDay": 0
		               }
		           });	    	    
		};

		$.fn.data_hora();
	});
	</script>
@endsection