<!-- No Instituicao Responsavel Previsao Field -->
<div class="form-group">
    {!! Form::label('no_instituicao_responsavel_previsao', 'Nome:') !!}
    {!! Form::text('no_instituicao_responsavel_previsao', null, ['class' => 'form-control']) !!}
</div>

@section('script-end')

	@parent

	<script type="text/javascript">
		$.fn.inputMaiusculo = function() {
            $('#no_instituicao_responsavel_previsao').keyup(function() {
    	        this.value = this.value.toUpperCase().trim();
    	    });
		};
	</script>
@endsection
