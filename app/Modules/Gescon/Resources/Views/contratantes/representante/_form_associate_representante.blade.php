<div class="row">
	<div class="col-xs-2 col-sm-2">
		<div class="form-group">
		    {!! Form::label('co_uasg', 'UASG:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner" style="display:none"></i>
		    {!! Form::hidden('id_orgao', null, ['class' => 'form-control', 'id' => 'id_orgao']) !!}
		    {!! Form::number('orgao[co_siafi]', null, ['class' => 'form-control', 'id' => 'co_siafi', 'disabled' => 'disabled']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('no_orgao', 'Órgão:') !!}
		    {!! Form::text('orgao[no_orgao]', null, ['class' => 'form-control', 'id' => 'no_orgao', 'disabled' => 'disabled']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 widget-container-col">
		<div class="widget-box widget-color-grey" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-users"></i>
						Representantes da UASG
				</h5>
				<div class="widget-toolbar no-border">
					<a href="#" class="btn btn-sm btn-success insert_representante" data-url="{{route('gescon::contratante_representante.create', ['id_contratante' => $contratante->id_contratante])}}" data-url-verificacao="{{route('gescon::contratantes.association_exist', ['id'=>$contratante->id_contratante])}}" data-rel="tooltip" data-original-title="Adicionar Representante">
				        <i class="ace-icon fa fa-user-plus bigger-110"></i>
				    </a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class="table-container-representante">
						@include('gescon::contratantes.representante._tabela_representantes')
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>

@include('gescon::contratantes.representante._modal_desvincular')

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>
	</div>
</div>

@section('script-end')

	@parent
    
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(function($) {                
            
        	$.fn.data_picker = function() {
        	    //Métodos responsáveis pela funcionalidade de Data (Calendário)
        	    $('.date-picker').datepicker({
        	        autoclose: true,
        	        todayHighlight: true,
        	        endDate: '0' //data nao pode ser superior ao dia atual
        	    });
        	};

        	$.fn.dinamic_table_representante = function() {
        	    //inicializa dataTables
        	    var oTable1 = $('#dynamic-table-representante')
        	        .dataTable({
        	            bAutoWidth: false,
        	            info:     false,
        	            searching: false,
        	            bLengthChange: false,
        	            "aoColumns": [
        	              { "sWidth": "15%", "bSortable": false },
        	              { "sWidth": "45%", "bSortable": false },
        	              { "sWidth": "15%", "bSortable": false },
        	              { "sWidth": "15%", "bSortable": false },
        	              { "sWidth": "10%", "bSortable": false }
        	            ],
        	            "aaSorting": []
        	        });
        	};

        	$(document).ready(function() {
        		$.fn.data_picker();
        	    $.fn.dinamic_table_representante(); 
        	});

        });
    </script>

    <script src="{{ asset('modules/gescon/js/ajax_crud_contratante.js') }}"></script>

@endsection