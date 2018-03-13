@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::inicio') !!}

@endsection

@section('content')

<div class="row">
	<div class="col-sm-5">
		<div class="widget-box">
			<div class="widget-header widget-header-flat">
				<h4 class="widget-title smaller">
				  <i class="ace-icon fa fa-calendar smaller-80"></i>
				  Calendário
				</h4>
			</div>

			<div class="widget-body">
				<div class="widget-main padding-4">
					<div class="row">
						<div class="col-sm-12 col-xs-12">

						    {!! $calendario->calendar() !!}
						      
						</div>    
					</div>    
				</div>    
			</div>

			<div class="widget-footer">
				<div class="widget-main padding-4">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
						    Legenda de Contratos a vencer em:              
						</div>  
					</div>
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<span class="label label-arrowed">
							    <i class="ace-icon fa fa-flag bigger-80"></i>
							    Vencido
							</span>
						    <span class="label label-danger">
						        <i class="ace-icon fa fa-flag bigger-80"></i>
						        30 dias
						    </span>
						    <span class="label label-warning">
						        <i class="ace-icon fa fa-flag bigger-80"></i>
						        120 dias
						    </span>
						    <span class="label label-success">
						        <i class="ace-icon fa fa-flag bigger-80"></i>
						        180 dias
						    </span>
						</div>    
					</div>    
				</div>    
			</div>                
		</div>
	</div>

	<div class="col-sm-7">
		<div class="widget-box" id="widget-box-2">
			<div class="widget-header">
				<h4 class="widget-title smaller">
					<i class="ace-icon fa fa-file-text-o"></i>
					Contratos a vencer em até 180 dias
				</h4>
			</div>

			<div class="widget-body" style="max-height:604px; overflow-x:auto;">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
								<th width="20%">Contrato - UASG</th>
								<th width="28%">Categoria</th>
								<th width="39%">Objeto</th>
								<th width="13%">Vencimento</th>
							</tr>
						</thead>

						<tbody>
							@if (isset($contratos))

								@foreach ($contratos as $contrato)
									<tr>
										<td>{{ $contrato->nr_contrato . ' - '. $contrato->co_uasg}}</td>
										<td>{{ $contrato->modalidade->no_modalidade}}</td>
										<td>{{ str_limit($contrato->ds_objeto, 40)}}</td>
										<td class="hidden-480">
											@if ($contrato->prazo_vencimento <= 30)
												<span class="label label-sm label-danger arrowed arrowed-right">{{ $contrato->dt_cessacao}}</span>
											@elseif ($contrato->prazo_vencimento > 30 && $contrato->prazo_vencimento <= 120)
												<span class="label label-sm label-warning arrowed arrowed-right">{{ $contrato->dt_cessacao}}</span>
											@else
												<span class="label label-sm label-success arrowed arrowed-right">{{ $contrato->dt_cessacao}}</span>
											@endif
										</td>
									</tr>
								@endforeach

							@else

								<tr>
									<td colspan="4">Não há contratos a vencer no período de 180 dias.</td>
								</tr>

							@endif	

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="div-modal-contrato">
	@include('gescon::_modal_Contrato')
</div>     

@endsection 

@section('css')
    @parent
    <!--CALENDAR -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" media="print" href="{{ URL::asset('assets/css/fullcalendar.print.min.css') }}" />

@stop

@section('script-end')
    <!--CALENDAR -->
    <script src="{{ URL::asset('assets/js/moment.min.js') }}" ></script>
    <script src="{{ URL::asset('assets/js/fullcalendar.min.js') }}" ></script>
    <script src="{{ URL::asset('assets/js/locale-all.js') }}" ></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

    {!! $calendario->script() !!}

    <script type="text/javascript">
      jQuery(function($) {

          $(document).ready(function() {
              $.fn.carregarDadosCalendario();
          });

          //Função responsável por limpar os dados do formulário Modal e disponibilizá-lo para cadastro
          $.fn.carregarDadosCalendario = function(objeto) {
	          if (objeto){
                  dialogCreate = bootbox.dialog({
                      message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                      closeButton: false
                  });
                  
                  var url = objeto.route + '/' + objeto.id;
                  
                  $.get(url, function (data) {
                      dialogCreate.modal('hide');
                      
                  }).done(function(data) {
                          
                      $('.div-modal-contrato').html(data.html);
                      $('#modal-contrato').modal('show');        
                      
                  });
              };  
          }
              

      });
    </script>

@stop