@extends('sisfone::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisfone::telefone.index') !!}

@endsection

@section('content')

    @section('page-header')
        Telefone
    @endsection
        
    <a href="{{route('sisfone::telefone.create')}}" class="btn btn-sm btn-primary">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>
    
   <table id="dynamic-table" class="table table-striped table-bordered table-hover">
       <thead>
           <th width="20%">Usuário</th>
           <th width="20%">Nº Telefone</th>
           <th width="10%">Tipo</th>
           <th width="20%">Principal</th>          
           <th width="10%">Orgão</th> 
           <th width="20%">Ação</th>
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
                    <td>
                       <?php
                       /*  O perfil de usuário pode alterar/excluir apenas telefones próprios.
                       */
                       ?>
                       @can('update', $telefone)
                       <a href="{{route('sisfone::telefone.edit',['id'=>$telefone->id_telefone])}}" class="btn btn-xs btn-info">
                           <i class="ace-icon fa fa-pencil"></i>
                       </a>
                       @endcan

                       @can('delete', $telefone)
                    
                       
                       <a href="#" data-id="{{ $telefone->id_telefone }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisfone::telefone.destroy',['id'=>$telefone->id_telefone])}}">
                           <i class="ace-icon fa fa-trash-o"></i>
                       </a>    
             
                       @endcan
                   </td>
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