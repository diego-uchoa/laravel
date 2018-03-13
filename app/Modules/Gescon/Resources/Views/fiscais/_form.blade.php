<div class="row">
	<div class="col-xs-6 col-sm-6">
		<div class="form-group">
			{!! Form::hidden('id_fiscal', isset($fiscal) ? $fiscal->id_fiscal : null, ['id' => 'id_fiscal']) !!}
		    {!! Form::label('nr_cpf', 'CPF:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_cpf" style="display:none"></i>
    	    <div class="input-group">
    		    @if($mode == "update")

    		    	{!! Form::text('nr_cpf', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf', 'readonly']) !!}

    		    @else

		    	    {!! Form::text('nr_cpf', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf']) !!}
		    	    <span class="input-group-btn">
		    		    <button class="btn btn-sm btn-default" type="button" id="bt_buscar_cpf" name="bt_buscar_cpf">
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
		    {!! Form::label('no_fiscal', 'Nome:') !!}
		    
		    @if($mode == "update")

		    	{!! Form::text('no_fiscal', null, ['class' => 'form-control', 'id' => 'no_fiscal', 'readonly']) !!}

		    @else

		    	{!! Form::text('no_fiscal', null, ['class' => 'form-control', 'id' => 'no_fiscal']) !!}

		    @endif
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-3 col-sm-3">
		<div class="form-group">
		    {!! Form::label('nr_siape', 'Matrícula SIAPE:') !!}

		    @if($mode == "update")
		    	
		    	{!! Form::text('nr_siape', null, ['class' => 'form-control input-mask-numero-siape', 'id' => 'nr_siape', 'readonly']) !!}

		    @else

		    	{!! Form::text('nr_siape', null, ['class' => 'form-control input-mask-numero-siape', 'id' => 'nr_siape']) !!}

		    @endif	
		</div>
	</div>
	<div class="col-xs-9 col-sm-9">
		<div class="form-group">
		    {!! Form::label('ds_email', 'Email:') !!}
		    {!! Form::text('ds_email', null, ['class' => 'form-control', 'id' => 'ds_email']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-6 col-sm-6">
		<div class="form-group">
		    {!! Form::label('nr_telefone', 'Telefone:') !!}
		    {!! Form::text('nr_telefone', null, ['class' => 'form-control input-mask-telefone-ddd', 'id' => 'nr_telefone']) !!}
		</div>
	</div>
</div>
