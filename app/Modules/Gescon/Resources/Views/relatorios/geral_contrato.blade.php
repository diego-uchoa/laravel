@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::relatorios.geral_contrato') !!}

@endsection

@section('content')
        
    @section('page-header')
        Contratos em Geral
    @endsection


    <div class="search-area well well-sm" style="background: #EFF3F8; border: 0;">
                             
        <h5 class="blue smaller">
            <i class="ace-icon fa fa-search light-grey bigger-110"></i>
            Filtros para Pesquisa
        </h5>

        <div class="row">

            {!! Form::open(['route'=>'gescon::relatorios.processa_geral', 'id'=>'formulario', 'class' => 'form-horizontal']) !!}
             
                @include("gescon::relatorios._form_filtro_pesquisa")

            {!! Form::close() !!}

        </div>

    </div>

    <div class="resultado_pesquisa">
        @include('gescon::relatorios._tabela_resultado_pesquisa')
    </div>

@endsection

@section('script-end')
    
    @parent

    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskMoney.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('js/select.js') }}"></script>

    <script type="text/javascript">

        $(document).on('click','#btnFormAJAX', function() {
            var url = document.getElementById("formulario").action;
            var form = new FormData();

            //Recuperando os dados do formulário
            var formData = $('#formulario').serializeArray();    
            jQuery.each( formData, function( i, field ) {
                form.append(field.name, field.value);   
            });

            $.ajax({
                url: url,
                type: 'POST',
                data: form,
                dataType: 'json',
                contentType: false, 
                processData: false,
                
                beforeSend: function() {
                    dialogCreate = bootbox.dialog({
                        title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                        message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                        closeButton: true
                    });
                },
                success: function(data) {
                    dialogCreate.init(function(){
                        if (data.status == "success"){
                            
                            //Reload Tabela
                            $('.resultado_pesquisa').html(data.html);

                        }else{
                            dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                            var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                            if (typeof data.detail != "undefined"){
                                aviso = aviso + '<ul class="list-unstyled spaced">';    
                                aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                                aviso = aviso + '</ul>';        
                            }
                            dialogCreate.find('.bootbox-body').html(aviso);
                        }
                    });    

                },
                error: function(data){
                    if (typeof data.responseJSON == "undefined"){
                        var erro = '<ul class="list-unstyled spaced">';    
                        erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
                        erro = erro + '</ul>';    
                    }else{
                        var result = $.parseJSON(data.responseJSON.detail);
                        var erro = '<ul class="list-unstyled spaced">';
                        $.each(result, function(i, field){
                            erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
                        });
                        erro = erro + '</ul>';    
                    }

                    dialogCreate.init(function(){
                        dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                        dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
                    });    
                    
                }
            }).done(function() {
                $("[data-rel=tooltip]").tooltip();;
                dialogCreate.modal('hide');
            });
        });


        //Métodos responsáveis pela funcionalidade de Data (Calendário)
        $.fn.data_picker = function() {
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
          
            });

            $('.data_limite').datepicker('setEndDate', new Date().toDateString())
                .on('show', function(){
                    $('td.day.disabled').each(function(index, element){
                        var $element = $(element)
                        $element.attr("title", "A data não pode ser superior à atual");
                        $element.data("container", "body");
                        $element.tooltip()
                    });
                });

            $('.data_futura').datepicker('setStartDate', new Date().toDateString())
                .on('show', function(){
                    $('td.day.disabled').each(function(index, element){
                        var $element = $(element)
                        $element.attr("title", "A data não pode ser inferior à atual");
                        $element.data("container", "body");
                        $element.tooltip()
                    });
                });
        };

        $(document).ready(function() {
            $('.input-mask-numero-contrato').mask('9999/9999');
            $('.input-mask-numero-processo').mask('99999.999999/9999-99');
            $(".input-mask-money").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
            $.fn.chosen_select();
            $.fn.data_picker();
        });

    </script>

    <style type="text/css">
      tfoot {
          display: table-header-group;
      }

      tfoot input {
        width: 100%;
      }

      .form-group{
        margin-bottom: 10px;
      }

    </style>

@endsection