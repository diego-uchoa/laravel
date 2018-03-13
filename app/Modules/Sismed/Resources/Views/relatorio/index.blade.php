@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::relatorio.index') !!}

@endsection


@section('content')

    @section('page-header')
        Relatório - Estatística Atestados
    @endsection


    {!! Form::open(['route'=>'sismed::relatorio.atestado', 'id'=>'formulario', 'class' => 'form-horizontal']) !!}

    <div class="row">
        <div class="col-sm-4">
            <label for="id-date-picker-1">Data Início do Cadastro</label>
            <div class="row">
                <div class="col-xs-8 col-sm-11">
                    <div class="input-group">
                        <input class="form-control date-picker" id="dt_inicio_cadastro" type="text" data-date-format="dd/mm/yyyy" name='dt_inicio_cadastro' />
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <label for="id-date-picker-1">Data Fim do Cadastro</label>
            <div class="row">
                <div class="col-xs-8 col-sm-11">
                    <div class="input-group">
                        <input class="form-control date-picker" id="dt_fim_cadastro" type="text" data-date-format="dd/mm/yyyy" name='dt_fim_cadastro'/>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <br>
      <div class="col-sm-4">
          {!! Form::submit('Emitir Relatório',['class'=>'btn btn-sm btn-primary']) !!}
      </div>
    </div>

    {!! Form::close() !!}
  
  
@endsection




@section('script-end')
@parent

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
               language: 'pt-BR'
           })
           .next().on(ace.click_event, function(){
               $(this).prev().focus();
           });
      }

      $.fn.data_picker();

    });

        


</script>
@endsection