<div class="form-group">
    {!! Form::label('usuario', 'Usuário:') !!}
    {!! Form::select('id_usuario',$usuarios, null, ['class'=>'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('texto', 'Nº Telefone:') !!}
    {!! Form::text('tx_telefone', null, ['class'=>'form-control telefone_com_ddd']) !!}
</div>

<div class="form-group">
    {!! Form::label('tipoAvisoSistema', 'Tipo Aviso Sistema:') !!}
    {!! Form::select('id_tipo_telefone',$tipos, null, ['class'=>'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('sn_principal', 'Principal:') !!}
    {{Form::hidden('sn_principal', 0)}}
    {!! Form::checkbox('sn_principal') !!}   
</div>


{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>


@section('script-end')

	<script src="{{ URL::asset('assets/js/jquery.mask.min.js') }}"></script>
	<script src="{{ URL::asset('js/select.js') }}"></script>
	
	<script type="text/javascript">

		//TELEFONE
		jQuery(function($) {    
		  $('.telefone_com_ddd').mask('(00) 0000-0000');
		});

		//CAMPO Chosen
	    $.fn.chosen_select();
	</script>
@endsection