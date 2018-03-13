@extends('sismed::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sismed::servidor.atestado.cancelar',$servidor) !!}

@endsection

@include('errors.errors')

@section('page-header')
	Cancelar Atestado
@endsection


@section('content')

	<div class="alert alert-danger">
		<i class="ace-icon fa fa-hand-o-right"></i>
		Prezado usuário,
		a operação de CANCELAR ATESTADO deve ser utilizada quando o servidor apresentar o atestado, mas por algum motivo o mesmo não será cadastrado no SIASS.<br><br> O sistema manterá somente o registro do atestado, não influenciando no ciclo e acumulado do servidor. Ao cancelar o atestado os atestados listados abaixo poderão ser alterados. Deseja continuar com o cancelamento?
		
	</div>

	<div class="form">

		{!! Form::model($atestado, ['route'=>['sismed::atestado.cancelar',$atestado->id_atestado ],'method'=>'GET', 'id'=>'formulario','files' => true, 'name'=>'formulario', 'enctype' => 'multipart/form-data']) !!}

		<input type="hidden" name="id_atestado" value="{!! $atestado->id_atestado !!}">


		<div class="table-container">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<th>Área de Atendimento</th>
					<th>Tipo de Afastamento</th>
					<th>Tipo de Perícia</th>
					<th>CRM</th>
					<th>Prazo</th>           
					<th>Início</th>
					<th>Fim</th>
					<th>Situação</th>
					
				</thead>
				<tbody>
					@foreach($atestados as $atestado)
					<tr>
						<td>{{$atestado->areaAtendimento() }}</td>
						<td>{{$atestado->tipoAfastamento() }}</td>
						<td>{{$atestado->tipoPericia() }}</td>
						<td>{{$atestado->nr_crm }}</td>
						<td>{{$atestado->te_prazo }}</td>
						<td>{{$atestado->dt_inicio_afastamento }}</td>
						<td>{{$atestado->dt_fim_afastamento }}</td>
						<td>{{$atestado->situacao() }}</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div class="wizard-actions">
			<a href="{{route('sismed::servidor.atestados',['id'=>$atestado->id_servidor])}}" class="btn btn-danger">
				<i class="ace-icon fa fa-arrow-left"></i>
				Voltar
			</a>

			<button class="btn btn-primary btn-next" type="submit">
				Continuar
				<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
			</button>
		</div>

		{!! Form::close() !!}


	</div>

	<br>    




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



@endsection
