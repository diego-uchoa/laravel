@extends('sisfone::layouts.master-modal')

@section('content')

    @section('page-header')
        <i class="ace-icon fa fa-phone orange"></i> Lista Telefônica
    @endsection
        
   <table id="dynamic-table" class="table table-striped table-bordered table-hover">
       <thead>
           <th>Usuário</th>
           <th>Nº Telefone</th>
           <th>Tipo</th>
           <th>Principal</th>          
           <th>Orgão</th>            
       </thead>
       <tbody>
           @foreach($telefones as $telefone)
               <tr>
                   <td>{{$telefone->usuario->no_usuario}}</td>
                   <td>{{$telefone->tx_telefone}}</td>
                   <td>{{$telefone->tipo->no_tipo_telefone}}</td>
                   <td>
                    @if($telefone->sn_principal)
                        Principal
                    @else
                        -
                    @endif
                    </td>
                    <td>{{$telefone->usuario->orgao->sg_orgao}}</td>                 
               </tr>
           @endforeach
       </tbody>
   </table>

@endsection

@section('script-end')

<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/dataTables.tableTools.min.js') }}"></script>

<script type="text/javascript">
    jQuery(function($) {                
        //inicializa dataTables
        var oTable1 = $('#dynamic-table')
            .dataTable({
                bAutoWidth: false,
                "aoColumns": [
                  { "bSortable": true },
                  { "bSortable": true },
                  { "bSortable": true },
                  { "bSortable": true },
                  { "bSortable": true }                  
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
        
        //controla opcoes de marcar/desmarcar todas as linhas da tabela
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
            var th_checked = this.checked;  
            $(this).closest('table').find('tbody > tr').each(function() {
                var row = this;
                if(th_checked) tableTools_obj.fnSelect(row);
                else tableTools_obj.fnDeselect(row);
            });
        });
        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
            var row = $(this).closest('tr').get(0);
            if(!this.checked) tableTools_obj.fnSelect(row);
            else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });
    });
</script>
@endsection