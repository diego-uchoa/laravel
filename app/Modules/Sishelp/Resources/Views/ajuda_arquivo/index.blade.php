@extends('sishelp::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sishelp::ajuda_arquivo.index') !!}

@endsection

@section('content')
    
    @section('page-header')
        Ajuda Arquivo
    @endsection
        
    <a href="{{route('sishelp::ajuda_arquivo.create')}}" class="btn btn-sm btn-primary">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>
    
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <th>Nome</th>
            <th>Arquivo</th>
            <th>Sistema</th>
            <th>File</th>
            <th>Ação</th>
        </thead>
        <tbody>
            @foreach($arquivos as $arquivo)
                <tr>
                    <td>{{$arquivo->no_ajuda_arquivo}}</td>
                    <td>{{$arquivo->no_ajuda_arquivo_original}}</td>
                    <td>{{$arquivo->sistema->no_sistema}}</td>
                    <td>  
                    <a href="/uploads/Sishelp/{{ $arquivo->no_ajuda_arquivo_fisico }}">Link</a> 
                    </td>
                    <td>
                        <a href="{{route('sishelp::ajuda_arquivo.edit',['id'=>$arquivo->id_ajuda_arquivo])}}" class="btn btn-xs btn-info">
                            <i class="ace-icon fa fa-pencil"></i>
                        </a>
                        <a href="{{route('sishelp::ajuda_arquivo.destroy',['id'=>$arquivo->id_ajuda_arquivo])}}" class="btn btn-xs btn-danger">
                            <i class="ace-icon fa fa-trash-o"></i>
                        </a>
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
            //inicializa dataTables
            var oTable1 = $('#dynamic-table')
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                       { "bSortable": true },                     
                       { "bSortable": true }, 
                       { "bSortable": true },                       
                       { "bSortable": false },
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
@endsection