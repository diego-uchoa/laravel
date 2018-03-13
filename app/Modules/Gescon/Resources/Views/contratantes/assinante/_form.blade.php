<div class="row">
	<div class="col-xs-6 col-sm-6">
		<div class="form-group">

			{!! Form::label('nr_cpf_assinante', 'CPF:') !!}
			<i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_assinante" style="display:none"></i>
			<div class="input-group">
			    
			    @if($mode == "update")

					{!! Form::text('nr_cpf_assinante', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf_assinante', 'readonly']) !!}

				@else

					{!! Form::text('nr_cpf_assinante', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf_assinante']) !!}
					<span class="input-group-btn">
					    <button class="btn btn-sm btn-default" type="button" id="bt_buscar_cpf">
					        <i class="ace-icon fa fa-location-arrow bigger-110"></i>
					        Buscar!
					    </button>
					</span>

				@endif
			    
			</div>
			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('no_assinante', 'Nome:') !!}
		    {!! Form::text('no_assinante', null, ['class' => 'form-control', 'id' => 'no_assinante']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('ds_funcao_assinante', 'Função:') !!}
		    {!! Form::text('ds_funcao_assinante', null, ['class' => 'form-control', 'id' => 'ds_funcao_assinante']) !!}
		</div>
	</div>
</div>

@section('script-end')

	@parent
    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {                
            
        	$(document).ready(function() {
        	    $('.input-mask-cpf').mask('999.999.999-99');
        	});

        	$.fn.carregarFuncoes = function() {
        	    $('.input-mask-cpf').mask('999.999.999-99');
        	};

			$.fn.setDisabled = function(state) {
				$("#no_assinante").prop("disabled", state);
			};
        });
    </script>

    <script src="{{ asset('modules/gescon/js/ajax_busca_assinante_por_cpf.js') }}"></script>

@endsection