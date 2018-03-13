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
						Assinantes da UASG
				</h5>
				<div class="widget-toolbar no-border">
					<a href="#" class="btn btn-sm btn-success insert_assinante" data-url="{{route('gescon::contratante_assinante.create', ['id_contratante' => $contratante->id_contratante])}}" data-rel="tooltip" data-original-title="Adicionar Assinante">
				        <i class="ace-icon fa fa-user-plus bigger-110"></i>
				    </a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<div class="table-container-assinante">
						@include('gescon::contratantes.assinante._tabela_assinantes')
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>


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
    <script type="text/javascript">
        jQuery(function($) {                
            
        	$.fn.dinamic_table_assinante = function() {
        	    //inicializa dataTables
        	    var oTable1 = $('#dynamic-table-assinante')
        	        .dataTable({
        	            bAutoWidth: false,
        	            info:     false,
        	            searching: false,
        	            bLengthChange: false,
        	            "aoColumns": [
        	              { "sWidth": "20%", "bSortable": false },
        	              { "sWidth": "40%", "bSortable": false },
        	              { "sWidth": "30%", "bSortable": false },
        	              { "sWidth": "10%", "bSortable": false }
        	            ],
        	            "aaSorting": []
        	        });
        	};

        	$(document).ready(function() {
        	    $.fn.dinamic_table_assinante(); 
        	});
        });
    </script>

    <script src="{{ asset('modules/gescon/js/ajax_crud_contratante.js') }}"></script>

@endsection