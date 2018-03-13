<div class="form-group">
    {!! Form::label('id_sistema', 'Sistema:') !!}
    {!! Form::select('id_sistema',$sistemas, null, ['class'=>'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('no_perfil', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('descricao', 'Descrição:') !!}
    {!! Form::textarea('ds_perfil', null, ['class'=>'form-control']) !!}
</div>

@section('script-end')
	@parent

	<script src="{{ URL::asset('js/select.js') }}"></script>
	   
	<script type="text/javascript">

	    //Método responsável por adicionar o estilo ao select
	    $('#modal-create').on('shown.bs.modal', function () {
	        $.fn.chosen_select();
	    });

	</script>

@endsection

