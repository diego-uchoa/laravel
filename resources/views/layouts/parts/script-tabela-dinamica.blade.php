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
                  { "bSortable": false },
                  null, null,null, 
                  { "bSortable": false }
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