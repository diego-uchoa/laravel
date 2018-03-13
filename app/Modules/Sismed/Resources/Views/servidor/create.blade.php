@extends('sismed::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sismed::servidor.create') !!}

@endsection


@section('page-header')
	Criar Novo Servidor
@endsection


@section('content')

	<div class="row" class=".container">
		{!! Form::open(['route'=>['sismed::servidor.consultaws'], 'method'=>'post', 'id'=>'formulario-consulta']) !!}
		
			<div class="col-xs-2">    
				{!! Form::label('cpf', 'Consultar CPF:') !!}
				{!! Form::text('nr_cpf', null, ['class'=>'form-control input-large input-mask-cpf', 'id'=>'nr_cpf']) !!}
			</div>
			<div class="col-xs-1">
            <div class="form-group">
	                <label>&nbsp;</label>
	                <button  id='btnFormConsultarWsAjax' type="button" class="btn btn-sm btn-info" data-url="{{route('sismed::servidor.consultaws')}}"><i class="ace-icon fa fa-pencil"></i>Consultar</button>
	            </div>
	        </div>
		
		{!! Form::close() !!}
	
    </div>

    <div class="row">
        <hr>
    </div>

	<div class="form">
		{!! Form::open(['route'=>['sismed::servidor.store'], 'id'=>'formulario']) !!}

                @include('sismed::servidor._form',['submit_text' => 'Salvar'])
                
        {!! Form::close() !!}
	</div>

@endsection



@section('script-end')
@parent

<script src="{{ asset('modules/sismed/js/servidor.js') }}"></script>

@endsection