<div class="row">
	<div class="col-xs-6 col-sm-6">
		<div class="form-group">
		    {!! Form::label('nr_cpf', 'Cpf:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_usuario" style="display:none"></i>
		    <div class="input-group">
		        {!! Form::text('nr_cpf', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf']) !!}
		        <span class="input-group-btn">
		            <button class="btn btn-sm btn-default" type="button" id="bt_buscar_cpf">
		                <i class="ace-icon fa fa-location-arrow bigger-110"></i>
		                Buscar!
		            </button>
		        </span>
		    </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('no_usuario', 'Nome:') !!}
		    {!! Form::hidden('id_usuario', null, ['class' => 'form-control', 'id' => 'id_usuario']) !!}
		    {!! Form::text('no_usuario', null, ['class' => 'form-control', 'id' => 'no_usuario', 'readonly']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('email', 'Email:') !!}
		    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'readonly']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('no_orgao', 'Órgão:') !!}
		    {!! Form::text('no_orgao', null, ['class' => 'form-control', 'id' => 'no_orgao', 'readonly']) !!}
		</div>
	</div>
</div>

@section('script-end')

	@parent
    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {                
        	$.fn.carregarFuncoes = function() {
        	    $('.input-mask-cpf').mask('999.999.999-99');
        	};
        });
    </script>

    <script src="{{ asset('modules/gescon/js/ajax_busca_usuario_perfil_sistema.js') }}"></script>

@endsection