<div class="row">
    <div class="col-sm-3">
		<div class="form-group">
		    {!! Form::label('in_tipo_contratada', 'Tipo Contratada:') !!}
		    {!! Form::select('in_tipo_contratada', $listaTipoContratada, isset($contratada) ? $contratada->in_tipo_contratada : null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-sm-9">
		<div class="form-group">
		    {!! Form::label('nr_cpf_cnpj', 'CPF/CNPJ:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_cpf_cnpj" style="display:none"></i>
		    {!! Form::hidden('id_contratada', isset($contratada) ? $contratada->id_contratada : null, ['id' => 'id_contratada']) !!}
		    <div class="input-group">
		        {!! Form::text('nr_cpf_cnpj', isset($contratada) ? $contratada->nr_cpf_cnpj : null, ['class'=>'form-control input-mask-cpf-cnpj', 'id' => 'nr_cpf_cnpj']) !!}
		        <span class="input-group-btn">
		            <button class="btn btn-sm btn-default" type="button" id="bt_buscar_contratada">
		                <i class="ace-icon fa fa-location-arrow bigger-110"></i>
		                Buscar!
		            </button>
		        </span>
		    </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
		    {!! Form::label('no_razao_social', 'Nome/Razão Social:') !!}
		    {!! Form::text('no_razao_social', isset($contratada) ? $contratada->no_razao_social : null, ['class' => 'form-control upper', 'id' => 'no_razao_social', 'maxlength' => 200]) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-3">
		<div class="form-group">
		    {!! Form::label('ed_cep_logradouro', 'CEP:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_cep" style="display:none"></i>
		    <div class="input-group">
			    {!! Form::text('ed_cep_logradouro', isset($contratada) ? $contratada->ed_cep_logradouro : null, ['class' => 'form-control input-mask-cep', 'id' => 'ed_cep_logradouro']) !!}
			    <span class="input-group-btn">
				    <button class="btn btn-sm btn-default" type="button" id="bt_buscar_cep" name="bt_buscar_cep">
				    	<i class="ace-icon fa fa-location-arrow bigger-110"></i>
				    	Buscar!
				    </button>
			    </span>
	    	</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="form-group">
		    {!! Form::label('ed_logradouro', 'Logradouro:') !!}
		    {!! Form::text('ed_logradouro', isset($contratada) ? $contratada->ed_logradouro : null, ['class' => 'form-control', 'id' => 'ed_logradouro', 'maxlength' => 255]) !!}
		</div>
	</div>
</div>	

<div class="row">
	<div class="col-sm-3">
		<div class="form-group">
		    {!! Form::label('ed_numero_logradouro', 'Numero:') !!}
		    {!! Form::number('ed_numero_logradouro', isset($contratada) ? $contratada->ed_numero_logradouro : null, ['class' => 'form-control', 'id' => 'ed_numero_logradouro']) !!}
		</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group">
		    {!! Form::label('ed_complemento_logradouro', 'Complemento:') !!}
		    {!! Form::text('ed_complemento_logradouro', isset($contratada) ? $contratada->ed_complemento_logradouro : null, ['class' => 'form-control', 'id' => 'ed_complemento_logradouro', 'maxlength' => 255]) !!}
		</div>		
	</div>		
	<div class="col-sm-4">
		<div class="form-group">
		    {!! Form::label('ed_bairro_logradouro', 'Bairro:') !!}
		    {!! Form::text('ed_bairro_logradouro', isset($contratada) ? $contratada->ed_bairro_logradouro : null, ['class' => 'form-control', 'id' => 'ed_bairro_logradouro', 'maxlength' => 200]) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-3">
		<div class="form-group">
		    {!! Form::label('id_uf_logradouro', 'Uf:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_uf" style="display:none"></i>
		    {!! Form::select('id_uf_logradouro', $listaUF, isset($contratada) ? $contratada->municipio->uf->id_uf : null, ['id' => 'id_uf_logradouro', 'class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-sm-5">
		<div class="form-group">
		    {!! Form::label('id_municipio_logradouro', 'Município:') !!}
		    {!! Form::select('id_municipio_logradouro', $listaMunicipio, isset($contratada) ? $contratada->id_municipio_logradouro : null, ['id' => 'id_municipio_logradouro', 'class'=>'form-control']) !!}
		</div>		
	</div>
</div>

<div class="row">
	<div class="col-sm-8">
		<div class="form-group">
		    {!! Form::label('no_representante', 'Representante Legal:') !!}
		    {!! Form::text('no_representante', isset($contratada) ? $contratada->no_representante : null, ['class' => 'form-control', 'id' => 'no_representante', 'maxlength' => 200]) !!}
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
		    {!! Form::label('nr_telefone', 'Telefone:') !!}
		    {!! Form::text('nr_telefone', isset($contratada) ? $contratada->nr_telefone : null, ['class' => 'form-control input-mask-telefone-ddd', 'id' => 'nr_telefone']) !!}
		</div>
	</div>
</div>

<div class="form-group">
    {!! Form::label('ds_email', 'Email:') !!}
    {!! Form::text('ds_email', isset($contratada) ? $contratada->ds_email : null, ['class' => 'form-control', 'id' => 'ds_email', 'maxlength' => 100]) !!}
</div>