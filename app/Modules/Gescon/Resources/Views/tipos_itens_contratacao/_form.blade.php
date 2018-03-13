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

<!-- Ds Tipo Item Contratacao Field -->
<div class="form-group">
    {!! Form::label('ds_tipo_item_contratacao', 'Descrição:') !!}
    {!! Form::text('ds_tipo_item_contratacao', null, ['class' => 'form-control', 'id' => 'ds_tipo_item_contratacao']) !!}
</div>

@section('script-end')

	@parent

	<script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>

@endsection
