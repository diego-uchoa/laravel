@extends('sismed::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sismed::servidor.atestado.edit',$servidor) !!}

@endsection

@include('errors.errors')

@section('page-header')
	Editar Atestado
@endsection


@section('content')

	<div class="form">
		{!! Form::model($atestado, ['route'=>['sismed::atestado.update',$atestado->id_atestado ],'method'=>'put', 'id'=>'formulario','files' => true, 'name'=>'formulario', 'enctype' => 'multipart/form-data']) !!}

		
				<input type="hidden" name="id_servidor" value="{!! $servidor->id_servidor !!}">

				@if($atestado->no_atestado_fisico)
					@section('anexo')
						<input type="hidden" name="atestado_delete" value="false">
						<input type="hidden" name="atestado_atual" value="{!! $atestado->no_atestado_fisico !!}">
						<div id="row-anexo">
							<a href="/uploads/sismed/{{ $servidor->co_prontuario }}/{{ $atestado->no_atestado_fisico }}" class="btn btn-minier btn-yellow" target="_blank">
							    <i class="ace-icon fa fa-pencil-square-o"></i>Atestado
							    
							</a>
							<a href="#" class="btn btn-minier btn-danger" id="btn-exclur-atestado">
							    <i class="ace-icon fa fa-trash-o"></i>Excluir
							</a>
						</div>
						<div id="row-anexo-input" style="display: none">
							{!! Form::file('atestado', ['class'=>'form-control input-large', 'id'=>'arquivo-atestado']) !!}   
						</div>
	
					@endsection
				@else
					@section('anexo')
						<div id="row-anexo-input">
							{!! Form::file('atestado',['class'=>'form-control input-large', 'id'=>'arquivo-atestado']) !!}    
						</div>
					@endsection
				@endif
				

				@include('errors.errors')
				
				@include('sismed::servidor.atestado._form_edit')


				
				{!! Form::submit('Salvar', ['class'=>'btn btn-primary pull-right', 'id' => 'btnFormSalvar']) !!}
				<a href="{{route('sismed::servidor.atestados',['id'=>$atestado->id_servidor])}}" class="btn btn-large  btn-danger pull-right" style="margin-right: 5px;">Voltar</a>
				 
				<a href="{{route('sismed::atestado.emitir',['id'=>$atestado->id_atestado])}}" class="btn btn-default ">
                	<i class="ace-icon fa fa-file-text-o"></i>
                </a>

				


		{!! Form::close() !!}

	
    </div>

    <br>

    <h3 class="header smaller lighter grey">
      <i class="ace-icon fa fa-plus-square"></i>
      Perícias
    </h3>

    <div class="form">
    	<div class="table-pericia-container">
			@include('sismed::servidor.atestado.pericia._tabela')
		</div>
    </div>

    <div class="formulario-container">
    	@include('sismed::servidor.atestado.pericia._modal')
  	</div>

@endsection



@section('script-end')
@parent

<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/dataTables.tableTools.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>


<link rel="stylesheet" href="{{ URL::asset('assets/css/datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/daterangepicker.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datetimepicker.min.css') }}" />

<script src="{{ asset('modules/sismed/js/atestado-update.js') }}"></script>
<script src="{{ asset('modules/sismed/js/pericia-update.js') }}"></script>


<script>

    
    var dataInicioAfastamento = JSON.parse('{!! json_encode($dataInicioAfastamento) !!}');
    var dataFimAfastamento = JSON.parse('{!! json_encode($dataFimAfastamento) !!}');
    $('#formulario input[name=dt_inicio_afastamento]').val(dataInicioAfastamento);
    $('#formulario input[name=dt_fim_afastamento]').val(dataFimAfastamento);
    


</script>

@endsection
