<!-- Id Proposicao Field -->
@if(!isset($id_proposicao))
<div class="form-group">
    {!! Form::label('id_proposicao', 'Proposição:') !!}
    {!! Form::select('id_proposicao', $listaProposicoes, null, ['class'=>'chosen-select']) !!}
</div>
@else
    {!! Form::hidden('id_proposicao', $id_proposicao) !!}
@endif

<!-- Dt Envio Field -->
<div class="form-group">
    {!! Form::label('dt_envio', 'Data:') !!}
    <div class="input-group">
	    {!! Form::text('dt_envio', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy']) !!}
	    <span class="input-group-addon">
	        <i class="fa fa-calendar bigger-110"></i>
	    </span>
	</div>
</div>

<!-- Id Tipo Posicao Field -->
<div class="form-group">
    {!! Form::label('id_tipo_posicao', 'Posição:') !!}
    {!! Form::select('id_tipo_posicao', $listaTiposPosicao, null, ['data-placeholder' => 'Selecione ...', 'class'=>'chosen-select']) !!}
</div>

<!-- Id Orgao Field -->
<div class="form-group">
    {!! Form::label('id_orgao', 'Órgão:') !!}
    {!! Form::select('id_orgao', $listaOrgaos, null, ['class'=>'chosen-select']) !!}
</div>

<!-- No Documento Field -->
<div class="form-group">
    {!! Form::label('no_documento', 'Documento:') !!}
    {!! Form::text('no_documento', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Anexar arquivo:') !!}
    @yield('arquivo')   
</div>

<!-- Tx Descricao Field -->
<div class="form-group">
    {!! Form::label('tx_descricao', 'Descrição:') !!}
    {!! Form::textarea('tx_descricao', null, ['class' => 'form-control']) !!}
</div>

@section('script-end')

	@parent

	<script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

	<script type="text/javascript">

	        $.fn.chosen_select = function() {
	            if(!ace.vars['touch']) {
	                $('.chosen-select').chosen({allow_single_deselect:true}); 
	                //resize the chosen on window resize

	                $(window)
	                .off('resize.chosen')
	                .on('resize.chosen', function() {
	                    $('.chosen-select').each(function() {
	                         var $this = $(this);
	                         $this.next().css({'width': $this.parent().width()});
	                    })
	                }).trigger('resize.chosen');
	                //resize chosen on sidebar collapse/expand
	                $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
	                    if(event_name != 'sidebar_collapsed') return;
	                    $('.chosen-select').each(function() {
	                         var $this = $(this);
	                         $this.next().css({'width': $this.parent().width()});
	                    })
	                });
	            }
	        };

	        $.fn.data_picker = function() {
	            //Métodos responsáveis pela funcionalidade de Data (Calendário)
	            $('.date-picker').datepicker({
	                autoclose: true,
	                todayHighlight: true,
	            	endDate: '0' 

	            }).on('show', function(){
                $('td.day.disabled').each(function(index, element){
                    var $element = $(element)
                    $element.attr("title", "Data de envio não pode ser superior à atual");

                    $element.data("container", "body");
                    $element.tooltip()
                });
            });
	        }
	</script>
@endsection
