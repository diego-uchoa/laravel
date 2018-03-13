<!-- Co Tipo Situacao Field -->
<div class="form-group">
    {!! Form::label('co_tipo_situacao', 'Código na Casa:') !!}
    {!! Form::text('co_tipo_situacao', null, ['class' => 'form-control']) !!}
</div>

<!-- Tx Tipo Situacao Field -->
<div class="form-group">
    {!! Form::label('tx_tipo_situacao', 'Descrição:') !!}
    {!! Form::text('tx_tipo_situacao', null, ['class' => 'form-control']) !!}
</div>

<!-- Sg Casa Situacao Field -->
<div class="form-group">
    {!! Form::label('sg_casa_situacao', 'Casa:') !!}
    {!! Form::select('sg_casa_situacao', [null=>'Selecione ...'] + ['CD' => 'Câmara dos Deputados', 'SF' => 'Senado Federal'], null, ['class'=>'form-control']) !!}
</div>

<!-- Sg Status Situacao Field -->
<div class="form-group">
    {!! Form::label('sg_status_situacao', 'Status:') !!}
    {!! Form::select('sg_status_situacao', [null=>'Selecione ...'] + ['T' => 'Tramitando', 'S' => 'Sancionada', 'E' => 'Sem eficácia'], null, ['class'=>'form-control']) !!}
</div>

@section('script-end')

	@parent

	<script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>

	<script type="text/javascript">
	    
	    //FAVOR ADICIONAR AQUI AS FUNÇÕES ESPECÍFICAS PARA CADA FORMULÁRIO, A FUNÇÃO COMENTADA ABAIXO É RELACIONADA AO SELECT.
	    /*
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

	    //Método responsável por adicionar o estilo ao select
        $('#modal-create').on('shown.bs.modal', function () {
            $.fn.chosen_select();
        });
        */
	</script>
@endsection
