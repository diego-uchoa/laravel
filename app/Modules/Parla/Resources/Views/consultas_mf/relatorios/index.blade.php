@extends('parla::layouts.master')

@section('script-head')
    {!! Charts::assets() !!}

<script type="text/javascript">

</script>
@endsection

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::consultasMf.relatorio') !!}

@endsection

@section('content')
        
    @section('page-header')
        Relatórios das Consultas ao MF
    @endsection

    <div class="row">
        <div class="col-sm-4">
            {!! Form::open(['route'=>'parla::consultasMf.relatorio.generate', 'id'=>'formulario']) !!}
                @include('parla::consultas_mf.relatorios._form',['submit_text' => 'Salvar']) 
                {!! Form::button('<i class="ace-icon fa fa-refresh bigger-110"></i> Gerar relatório', ['class'=>'btn btn-sm btn-primary', 'id' => 'btnGerarRelatorio', 'disabled' => 'disabled', 'type' => 'submit']) !!}
                <a href="{{route('parla::consultasMf.index')}}" class="btn btn-sm btn-default">
                    Voltar
                </a>
            {!! Form::close() !!}

        </div>
    </div>
    <hr>
    <div class="row" id="relatorio-row">
        @include('parla::consultas_mf.relatorios.relatorio')
    </div>
@endsection


@section('script-end')
    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ asset('modules/parla/js/relatorios.js') }}"></script>
    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/daterangepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('assets/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>


    <link rel="stylesheet" href="{{ URL::asset('assets/css/datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datetimepicker.min.css') }}" />

    <script type="text/javascript">
        jQuery(function($) {
          //Data Picker
            $.fn.data_picker = function() {
                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',                
                    language: 'pt-BR',
                    endDate: '0' 
                })
                .next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });

                $("#dt_inicio").datepicker()
                   .on('changeDate', function(date){                                 
                        $('#dt_fim').datepicker('setStartDate',$('#dt_inicio').datepicker('getDate'));
                        var envioDate = $('#dt_inicio').datepicker('getDate');
                        var retornoDate = $('#dt_fim').datepicker('getDate');
                        if(!(retornoDate - envioDate > 7 * 86400 * 1000)) {
                            $('#dt_fim').datepicker('setDate',null);
                        }           
                   }).on('show', function(){
                    $('td.day.disabled').each(function(index, element){
                        var $element = $(element)
                        $element.attr("title", "Data de início do período não pode ser superior à atual");

                        $element.data("container", "body");
                        $element.tooltip()
                    });
                });

                $('#dt_fim').datepicker('setStartDate',$('#dt_inicio').datepicker('getDate'))
                    .on('show', function(){
                        $('td.day.disabled').each(function(index, element){
                            var $element = $(element)
                            $element.attr("title", "Data de fim do período não pode ser inferior à de início e nem superior à atual");

                            $element.data("container", "body");
                            $element.tooltip()
                        });
                    });
            }

            $.fn.data_picker();

        });
    </script>
@endsection

@section('script-end')
