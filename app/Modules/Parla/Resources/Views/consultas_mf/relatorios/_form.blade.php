<style type="text/css">
    #tipo-relatorio option:first-child {
        display: none;
    } 
</style>

<div class="form-group">
    {!! Form::label('in_tipo_relatorio', 'Tipo do relatório:') !!}
    {!! Form::select('in_tipo_relatorio', [1 => 'Relatório quantitativo de consultas a órgãos', 2 => 'Relatório analítico de consulta por órgão', 3 => 'Relatório por proposição legislativa'], null, ['placeholder' => 'Selecione ...', 'id' => 'tipo-relatorio', 'class'=>'form-control']) !!}
</div>

<br>

<div class="form-group">
    {!! Form::label('dt_inicio', 'Início do período de envio da consulta:') !!}
    <div class="input-group">
        {!! Form::text('dt_inicio', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_inicio']) !!}
        <span class="input-group-addon">
            <i class="fa fa-calendar bigger-110"></i>
        </span>
    </div>
</div>
<div class="form-group">
    {!! Form::label('dt_fim', 'Fim do período de envio da consulta:') !!}
    <div class="input-group">
        {!! Form::text('dt_fim', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_fim']) !!}
        <span class="input-group-addon">
            <i class="fa fa-calendar bigger-110"></i>
        </span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('sg_casa_tramitacao', 'Casa em que a proposição está tramitando:') !!}
    {!! Form::select('sg_casa_tramitacao', ['CD' => 'Câmara dos Deputados', 'SF' => 'Senado Federal'], null, ['placeholder' => 'Todas', 'id' => 'sg_casa_tramitacao', 'class'=>'form-control']) !!}
</div>

<div id="tipo-1">
</div>

<div id="tipo-2">
</div>

<div id="tipo-3">
</div>

@section('script-end')
    @parent

    <script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
       
    <script type="text/javascript">

        $.fn.inicia_formulario = function() {
            $('#tipo-1').hide();
            $('#tipo-2').hide();
            $('#tipo-3').hide();
        };
        
        $(document).on('change','#tipo-relatorio', function() {     
            if(this.value == 1) {
                $('#tipo-2').hide();
                $('#tipo-3').hide();
                $('#tipo-1').show();
                document.getElementById('btnGerarRelatorio').disabled = false;
            }
            else if(this.value == 2) {
                $('#tipo-1').hide();
                $('#tipo-3').hide();
                $('#tipo-2').show();
                document.getElementById('btnGerarRelatorio').disabled = false;
            }
            else if(this.value == 3) {
                $('#tipo-1').hide();
                $('#tipo-2').hide();
                $('#tipo-3').show();
                document.getElementById('btnGerarRelatorio').disabled = false;
            }
            else if(!this.value) {
                $('#tipo-1').hide();
                $('#tipo-2').hide();
                $('#tipo-3').hide();
                document.getElementById('btnGerarRelatorio').disabled = true;
            }
        });

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
    </script>
    
@endsection