@extends('layouts.master')

<?php $helper = app('App\Helpers\UtilHelper'); ?>

@section('content')

  <br><br>
    
  <div class="row">

    <div class="col-sm-1"></div>
    <!--
      /*  Lista de Sistemas
      */
    -->
    <div class="col-sm-6">
      <div class="widget-box">
        <div class="widget-header widget-header-flat">
          <h4 class="widget-title smaller">
            <i class="ace-icon fa fa-database smaller-80"></i>
            Sistemas
          </h4>
        </div>

        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                  @foreach($sistemas as $sistema)
                   <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                      <a href="{{ url('/' . $helper->getSistemaModulo($sistema->no_sistema) ) }}">

                          <div class="hvr-shrink">
                            {{ Html::image('icones/icone_' . $sistema->no_sistema . '.png', $sistema->no_sistema) }}
                            <div>
                              <h5 style="text-align: center;">{{$sistema->no_sistema}}</h5>
                            </div>
                         </div>
                       
                      </a>
                   </div>
                   @endforeach

              </div>    
            </div>    
          </div>    
        </div>
      </div>
    </div>

    <!--
      /*  Treeview de favoritos
      */
    -->
    <div class="col-sm-4">
      <div class="widget-box">
        <div class="widget-header widget-header-flat">
          <h4 class="widget-title smaller">
            <i class="ace-icon fa fa-star smaller-80"></i>
            Favoritos
          </h4>
        </div>

        <div class="widget-body">
          <div class="widget-main">
            <div class="row">
              <div class="col-sm-12 col-xs-12">

                  {!! $tree !!}  
                    
              </div>    
            </div>    
          </div>    
        </div>
      </div>
    </div>


  </div>

  <div class="row">

    <div class="col-sm-7"></div>
    <!--
      /*  Calendário
      */
    -->
    <div class="col-sm-4">
      <div class="widget-box">
        <div class="widget-header widget-header-flat">
          <h4 class="widget-title smaller">
            <i class="ace-icon fa fa-calendar smaller-80"></i>
            Calendário
          </h4>
        </div>

        <div class="widget-body">
          <div class="widget-main padding-4">
            <div class="row">
              <div class="col-sm-12 col-xs-12">

                  {!! $calendario->calendar() !!}
                    
              </div>    
            </div>    
          </div>    
        </div>

        <div class="widget-footer">
          <div class="widget-main padding-4">
            <div class="row">
              <div class="col-sm-4 col-xs-4">
                  Legenda:              
              </div>  
            </div>
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                  <span class="label label-success">
                      <i class="ace-icon fa fa-flag bigger-80"></i>
                      Aniversário
                  </span>
                  <span class="label label-warning">
                      <i class="ace-icon fa fa-flag bigger-80"></i>
                      Feriado
                  </span>
                  <span class="label label-info">
                      <i class="ace-icon fa fa-flag bigger-80"></i>
                      Evento
                  </span>
              </div>    
            </div>    
          </div>    
        </div>                

      </div>
    </div>

    <div class="col-sm-1"></div>

  </div>

  <div class="div-modal-feriado">
      @include('_modal_Feriado')
  </div>     

  <div class="div-modal-aniversario">
      @include('_modal_Aniversario')
  </div>     

  <div class="div-modal-evento">
      @include('_modal_Evento')
  </div>     

@endsection

@section('css')
    @parent
    <!--TREEVIEW -->    
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.treeview.css') }}" />

    <!--CALENDAR -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" media="print" href="{{ URL::asset('assets/css/fullcalendar.print.min.css') }}" />

@stop

@section('script-end')
    <!--TREEVIEW -->
    <script src="{{ URL::asset('assets/js/jquery-treeview.js') }}" ></script>

    <!--CALENDAR -->
    <script src="{{ URL::asset('assets/js/moment.min.js') }}" ></script>
    <script src="{{ URL::asset('assets/js/fullcalendar.min.js') }}" ></script>
    <script src="{{ URL::asset('assets/js/locale-all.js') }}" ></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

    {!! $calendario->script() !!}

    <!--ESPECIFICO DA PAGINA -->
    <script src="{{ URL::asset('js/views/home.js') }}" ></script>

    <script type="text/javascript">
      jQuery(function($) {
          
          //Função responsável por limpar os dados do formulário Modal e disponibilizá-lo para cadastro
          $.fn.carregarDadosCalendario = function(objeto) {
              if (objeto){
                      
                      dialogCreate = bootbox.dialog({
                          message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                          closeButton: false
                      });
                      
                      var url = objeto.route + '/' + objeto.id;
                      
                      $.get(url, function (data) {
                          dialogCreate.modal('hide');
                          
                      }).done(function(data) {
                          
                          switch(objeto.tipo) {
                              case 'feriado':
                                  $('.div-modal-feriado').html(data.html);
                                  $('#modal-feriado').modal('show');        
                                  break;
                              case 'aniversario':
                                  $('.div-modal-aniversario').html(data.html);
                                  $('#modal-aniversario').modal('show');        
                                  break;
                              default:
                                  $('.div-modal-evento').html(data.html);
                                  $('#modal-evento').modal('show');        
                          }         

                      });
                  };  
              }
              
          $.fn.carregarDadosCalendario();

      });
    </script>

@stop

