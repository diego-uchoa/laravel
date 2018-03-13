@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::atestado.show') !!}

@endsection

@section('content')

  @if(isset($servidor))
    
    @section('page-header')
        Prontuário: {{ $servidor->co_prontuario }}
    @endsection

    <h3 class="header smaller lighter grey">
      <i class="ace-icon fa fa-plus-square"></i>
      Atestados
    </h3>
    

   <div class="table-container">
    @include('sismed::servidor.atestado._tabela')
   </div>
  
  @endif  

@endsection

@section('script-end')
@parent

<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/dataTables.tableTools.min.js') }}"></script>


<script type="text/javascript">
    jQuery(function($) {

        //Tooltip
        $.fn.tooltip_campos = function() {
          $('[data-rel=tooltip]').tooltip({container:'body'});
          $('[data-rel=popover]').popover({container:'body'});
        }

        $.fn.tooltip_campos();
       
        $.fn.dinamic_table = function() {
            //inicializa dataTables (COLOCAR NUMERO DE COLUNAS)
          var oTable1 = $('#dynamic-table')
              .dataTable({
                  bAutoWidth: false,
                  "aoColumns": [
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": false }, //ARQUIVOS - Não tem botão de sort
                    { "bSortable": true },
                    { "bSortable": false } //ACOES - Não tem botão de sort
                  ],
                  "aaSorting": []
              });
      
          //inicializa TableTools
          var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {                  
              "sRowSelector": "td:not(:last-child)",
              "sRowSelect": "multi",
              "fnRowSelected": function(row) {
                  //check checkbox when row is selected
                  try { $(row).find('input[type=checkbox]').get(0).checked = true }
                  catch(e) {}
              },
              "fnRowDeselected": function(row) {
                  //uncheck checkbox
                  try { $(row).find('input[type=checkbox]').get(0).checked = false }
                  catch(e) {}
              },
              "sSelectedClass": "success",
          } );

        };

        $.fn.dinamic_table(); 

    });


</script>
@endsection