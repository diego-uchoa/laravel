<div class="row">
	<div class="col-xs-6 col-sm-6">
		<div class="form-group">

			{!! Form::label('nr_cpf_representante', 'Cpf:') !!}
			<i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_representante" style="display:none"></i>
			<div class="input-group">
			    
				@if(isset($mode))

					{!! Form::text('nr_cpf_representante', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf_representante', 'readonly']) !!}

				@else

					{!! Form::text('nr_cpf_representante', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf_representante']) !!}
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
		    {!! Form::label('no_representante', 'Nome:') !!}
		    {!! Form::text('no_representante', null, ['class' => 'form-control', 'id' => 'no_representante']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
		    {!! Form::label('nr_rg_representante', 'RG:') !!}
		    {!! Form::text('nr_rg_representante', null, ['class' => 'form-control', 'id' => 'nr_rg_representante']) !!}
		</div>
	</div>

	<div class="col-xs-8 col-sm-8">
		<div class="form-group">
		    {!! Form::label('ds_funcao_representante', 'Função:') !!}
		    {!! Form::text('ds_funcao_representante', null, ['class' => 'form-control', 'id' => 'ds_funcao_representante']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-4 col-sm-4">
		<div class="form-group">
		    {!! Form::label('dt_inicio', 'Data de Início (DOU):') !!}
		    <div class="input-group">
		        {!! Form::text('dt_inicio', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_inicio']) !!}
		        <span class="input-group-addon">
		            <i class="fa fa-calendar bigger-110"></i>
		        </span>
		    </div>
		</div>
	</div>
</div>

@section('script-end')

	@parent
    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {                
            
        	$.fn.data_picker = function() {
        	    //Métodos responsáveis pela funcionalidade de Data (Calendário)
        	    $('.date-picker').datepicker({
        	        autoclose: true,
        	        todayHighlight: true,
        	        endDate: '0' //data nao pode ser superior ao dia atual
        	    });
        	};

        	$(document).ready(function() {
        	    $.fn.data_picker();
        	    $('.input-mask-cpf').mask('999.999.999-99');
        	});

        	$.fn.carregarFuncoes = function() {
        	    $.fn.data_picker();
        	    $('.input-mask-cpf').mask('999.999.999-99');
        	};

			$.fn.setDisabled = function(state) {
				$("#no_representante").prop("disabled", state);
				$("#nr_rg_representante").prop("disabled", state);	    
				$("#dt_inicio").prop("disabled", state);	    
			};
        });
    </script>

    <script src="{{ asset('modules/gescon/js/ajax_busca_representante_por_cpf.js') }}"></script>

@endsection