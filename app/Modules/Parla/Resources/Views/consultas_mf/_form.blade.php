<!-- Id Proposicao Field -->
@if(!isset($id_proposicao))
<div class="form-group">
    {!! Form::label('id_proposicao', 'Proposição:') !!}
    {!! Form::select('id_proposicao', $listaProposicoes, null, ['class'=>'chosen-select form-control', 'id' => 'id_proposicao']) !!}
</div>
@else
    {!! Form::hidden('id_proposicao', $id_proposicao, ['id' => 'id_proposicao_hidden']) !!}
@endif

<!-- Id Orgao Field -->
<div class="form-group">
    {!! Form::label('id_orgao', 'Órgão:') !!}
    {!! Form::select('id_orgao', $listaOrgaos, null, ['class'=>'chosen-select']) !!}
</div>

<!-- Id Tipo Consulta Field -->
<div class="form-group">
    {!! Form::label('id_tipo_consulta', 'Tipo de Consulta:') !!}
    {!! Form::select('id_tipo_consulta', $listaTiposConsulta, null, ['class'=>'chosen-select']) !!}
</div>

<div class="form-group">
    {!! Form::label('no_comissao', 'Comissão:') !!}
    {!! Form::select('no_comissao', $listaComissoes, null, ['class'=>'chosen-select form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('nr_prioritario', 'Prioridade:') !!}
    <i class="ace-icon fa fa-spinner fa-spin blue bigger-125 loading_spinner_prioritario" style="display:none"></i>
    {!! Form::select('nr_prioritario', [1 => '1 (3 dias)', 2 => '2 (10 dias)', 3 => '3 (40 dias)'], null, ['class'=>'form-control', 'id' => 'nr_prioritario']) !!}
</div>

<!-- Dt Envio Field -->
<div class="form-group">
    {!! Form::label('dt_envio', 'Data de Envio:') !!}
    <div class="input-group">
        {!! Form::text('dt_envio', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_envio']) !!}
        <span class="input-group-addon">
            <i class="fa fa-calendar bigger-110"></i>
        </span>
    </div>
</div>

<!-- Id Tipo Posicao Field -->
<div class="form-group">
    {!! Form::label('id_tipo_posicao', 'Tipo da Posição:') !!}
    {!! Form::select('id_tipo_posicao', $listaTiposPosicao, null, ['data-placeholder' => 'Selecione ...', 'class'=>'chosen-select']) !!}
</div>

<!-- Dt Retorno Field -->
<div class="form-group">
    {!! Form::label('dt_retorno', 'Data Retorno:') !!}
    <div class="input-group">
        {!! Form::text('dt_retorno', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_retorno']) !!}
        <span class="input-group-addon">
            <i class="fa fa-calendar bigger-110"></i>
        </span>
    </div>
</div>

@section('script-end')
    @parent

    <script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
       
    <script type="text/javascript">
        $.fn.busca_prioritario_proposicao = function () {
            if($("#id_proposicao_hidden").length) {
                var v_proposicao = $('#id_proposicao_hidden').val();
                var v_url = "{{ url('parla/proposicoes/detalhes/prioritario/') }}";

                $.ajax({
                    url: v_url+'/'+v_proposicao,
                    type: 'GET',
                    dataType: 'json',
                    contentType: false, 
                    processData: false,
                    
                    beforeSend: function() {
                        $(".loading_spinner_prioritario").show();
                    },
                    success: function(data) {
                        $("#nr_prioritario").val(data);
                        $(".loading_spinner_prioritario").hide();
                    },
                    error: function(){
                        $(".loading_spinner_prioritario").hide();
                    }
                });
            }

            if($("#id_proposicao").length) {
                $("#id_proposicao").chosen().change(function() {
                    var v_proposicao = $('#id_proposicao').val();
                    var v_url = "{{ url('parla/proposicoes/detalhes/prioritario/') }}";
                    
                    //Verifica se campo cep possui valor informado.
                    if (v_proposicao != "") {
                        $.ajax({
                            url: v_url+'/'+v_proposicao,
                            type: 'GET',
                            dataType: 'json',
                            contentType: false, 
                            processData: false,
                            
                            beforeSend: function() {
                                $(".loading_spinner_prioritario").show();
                            },
                            success: function(data) {
                                $("#nr_prioritario").val(data);
                                $(".loading_spinner_prioritario").hide();
                            },
                            error: function(){
                                $(".loading_spinner_prioritario").hide();
                            }
                        });
                    }
                });
            }
        }

        $(document).on('click','#bt-buscar-comissao', function() {

            var v_proposicao = $('#id_proposicao').val();
            var url = "{{ url('parla/proposicoes/ultima-tramitacao/') }}" + "/" + v_proposicao;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                contentType: false, 
                processData: false,
                
                beforeSend: function() {
                    dialogCreate = bootbox.dialog({
                        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                        closeButton: true
                    });
                },
                success: function(data) {
                    dialogCreate.init(function(){
                        $('#formulario input[name=no_comissao]').val(data.no_orgao_tramitacao);
                        dialogCreate.modal('hide');
                        
                    });    
                },
                error: function(){
                    dialogCreate.modal('hide');
                }
            });
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

        $.fn.data_picker = function() {
            //Métodos responsáveis pela funcionalidade de Data (Calendário)
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true,
                endDate: '0' //data nao pode ser superior ao dia atual
            });

            //nao permite que a data de retorno seja inferior a data de envio
            $("#dt_envio").datepicker()
                .on('changeDate', function(date){                                 
                    $('#dt_retorno').datepicker('setStartDate',$('#dt_envio').datepicker('getDate'));
                    var envioDate = $('#dt_envio').datepicker('getDate');
                    var retornoDate = $('#dt_retorno').datepicker('getDate');
                    if(!(retornoDate - envioDate > 7 * 86400 * 1000)) {
                        $('#dt_retorno').datepicker('setDate',null);
                    }           
                }).on('show', function(){
                    $('td.day.disabled').each(function(index, element){
                        var $element = $(element)
                        $element.attr("title", "Data de envio não pode ser superior à atual");

                        $element.data("container", "body");
                        $element.tooltip()
                    });
                });

            $('#dt_retorno').datepicker('setStartDate',$('#dt_envio').datepicker('getDate'))
                .on('show', function(){
                    $('td.day.disabled').each(function(index, element){
                        var $element = $(element)
                        $element.attr("title", "Data de retorno não pode ser inferior à de envio e nem superior à atual");

                        $element.data("container", "body");
                        $element.tooltip()
                    });
                });
        };
    </script>
    
@endsection