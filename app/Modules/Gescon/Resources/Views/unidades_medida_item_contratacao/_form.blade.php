<!-- In Objeto Field -->
<div class="form-group">
    {!! Form::label('in_objeto', 'Objeto:') !!}
    	
    @if($mode == "update")
    	{!! Form::hidden('in_objeto', null, ['class' => 'form-control', 'id' => 'in_objeto']) !!}
    	{!! Form::text('ds_objeto', $ds_objeto, ['class' => 'form-control', 'id' => 'ds_objeto', 'readonly']) !!}
    @else
    	{!! Form::select('in_objeto', $listaObjeto, null, ['class' => 'form-control', 'id' => 'in_objeto']) !!}
    @endif
</div>

<div class="row">
    <div class="col-sm-8">
    	<!-- Ds Unidade Medida Item Contratacao Field -->
		<div class="form-group">
		    {!! Form::label('ds_unidade_medida_item_contratacao', 'Descrição:') !!}
		    {!! Form::text('ds_unidade_medida_item_contratacao', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="col-sm-4">
		<!-- Sg Unidade Medida Item Contratacao Field -->
		<div class="form-group">
		    {!! Form::label('sg_unidade_medida_item_contratacao', 'Sigla:') !!}
		    {!! Form::text('sg_unidade_medida_item_contratacao', null, ['class' => 'form-control']) !!}
		</div>
	</div>
</div>