<div class="row">
	<div class="col-xs-3 col-sm-3">
		<div class="form-group">
		    {!! Form::label('co_uasg', 'UASG:') !!}
		    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner" style="display:none"></i>
		    {!! Form::hidden('id_orgao', null, ['class' => 'form-control', 'id' => 'id_orgao']) !!}
		    <div class="input-group">
		        {!! Form::number('co_uasg', null, ['class' => 'form-control', 'id' => 'co_uasg']) !!}
		        <span class="input-group-btn">
		            <button class="btn btn-sm btn-default" type="button" id="bt_buscar_uasg">
		                <i class="ace-icon fa fa-location-arrow bigger-110"></i>
		                Buscar!
		            </button>
		        </span>
		    </div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="form-group">
		    {!! Form::label('no_contratante', 'Órgão:') !!}
		    {!! Form::text('no_contratante', null, ['class' => 'form-control', 'id' => 'no_contratante', 'disabled' => 'disabled']) !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 widget-container-col">
		<div class="widget-box widget-color-grey" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-users"></i>
						Dados do Representante
				</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="form-group">
							    {!! Form::label('nr_cpf_representante', 'Cpf:') !!}
							    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_representante" style="display:none"></i>
							    <div class="input-group">
							        {!! Form::text('nr_cpf_representante', null, ['class' => 'form-control input-mask-cpf', 'id' => 'nr_cpf_representante']) !!}
							        <span class="input-group-btn">
							            <button class="btn btn-sm btn-default" type="button" id="bt_buscar_cpf">
							                <i class="ace-icon fa fa-location-arrow bigger-110"></i>
							                Buscar!
							            </button>
							        </span>
							    </div>
							</div>
						</div>

						<div class="col-xs-9 col-sm-9">
							<div class="form-group">
							    {!! Form::label('no_representante', 'Nome:') !!}
							    {!! Form::text('no_representante', null, ['class' => 'form-control', 'id' => 'no_representante']) !!}
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-3 col-sm-3">
							<div class="form-group">
							    {!! Form::label('nr_rg_representante', 'RG:') !!}
							    {!! Form::text('nr_rg_representante', null, ['class' => 'form-control', 'id' => 'nr_rg_representante']) !!}
							</div>
						</div>

						<div class="col-xs-4 col-sm-4">
							<div class="form-group">
							    {!! Form::label('ds_funcao_representante', 'Função:') !!}
							    {!! Form::text('ds_funcao_representante', null, ['class' => 'form-control', 'id' => 'ds_funcao_representante']) !!}
							</div>
						</div>

						<div class="col-xs-3 col-sm-3">
							<div class="form-group">
							    {!! Form::label('dt_inicio', 'Data de Início (DOU):') !!}
							    <div class="input-group">
							        {!! Form::text('dt_inicio', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_inicio']) !!}
							        <span class="input-group-addon">
							            <i class="fa fa-calendar bigger-110"></i>
							        </span>
							    </div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>	
	</div>
</div>




<div class="row">
	<div class="col-xs-12 col-sm-12">
		<br>
		{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
		<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>
	</div>
</div>

@section('script-end')

	@parent
    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
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

        	$(document).on('click','#bt_buscar_uasg', function() {

            	var v_coUasg = $('#co_uasg').val();
            	var url = "{{ url('sisadm/orgaos/siafi/') }}" + "/" + v_coUasg;

            	if (v_coUasg.length == 6)
		        {
		            $.ajax({
		                url: url,
		                type: 'GET',
		                dataType: 'json',
		                contentType: false, 
		                processData: false,
		                
		                beforeSend: function() {
		                    $(".loading_spinner").show();
		                },
		                success: function(data) {
		                	if (data.status != "error"){
			                	$('#id_orgao').val(data.id_orgao);
		                        $('#no_contratante').val(data.no_orgao);
		                    }else{
		                    	dialogCreate = bootbox.dialog({
			                	    message: '<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>UASG não encontrada.</p>',
			                	    closeButton: true
			                	});
		                    }
		                    $(".loading_spinner").hide();
		                },
		                error: function(){
		                	dialogCreate = bootbox.dialog({
		                	    message: '<p class="text-center"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>UASG não encontrada.</p>',
		                	    closeButton: true
		                	});
		                	$('#formulario').each (function(){
		                		this.reset();
		                	});
		                    $(".loading_spinner").hide();
		                }
		            });
		        }    

            });

			$(document).ready(function() {
			    $.fn.data_picker();
			});

			$('.input-mask-cpf').mask('999.999.999-99');

			$.fn.setDisabled = function(state) {
				$("#no_representante").prop("disabled", state);
				$("#nr_rg_representante").prop("disabled", state);	    
				$("#dt_inicio").prop("disabled", state);	    
			};

        });
    </script>

    <script src="{{ asset('modules/gescon/js/ajax_busca_representante_por_cpf.js') }}"></script>

@endsection