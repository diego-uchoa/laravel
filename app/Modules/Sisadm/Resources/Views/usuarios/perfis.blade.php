@inject('perfilService', 'App\Modules\Sisadm\Services\PerfilService')

@extends('sisadm::layouts.master')

@section('breadcrumbs-page')
<li>
    <a href="#">Perfis Usuários</a>
</li>
<li class="active">Lista</li>
@endsection

@section('content')

        @section('page-header')
            Gerenciando perfis do usuário
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{$usuario->no_usuario}}
            </small>
        @endsection

        
        {!! Form::open(['route'=>['sisadm::usuarios.perfis.store', $usuario->id_usuario]]) !!}       
        <table id="dynamic-table" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="center">
                        <label class="pos-rel">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>Perfil</th>
                    <th>Sistema</th>
                    <th>Itens de Menu</th>
                </tr>
            </thead>

            <tbody>
                
                @foreach($sistemas as $sistema)
                        
                        <tr>
                            <td style="background-color: #DDD"></td> 
                            <th style="background-color: #DDD" class="center">
                                {!! $sistema->no_sistema !!}
                            </th>
                            <td style="background-color: #DDD"></td>
                            <td style="background-color: #DDD"></td>
                        </tr>
                        
                        @foreach($sistema->perfis as $perfil)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    {!! Form::checkbox("perfis[]", $perfil->id_perfil, in_array($perfil->id_perfil,$perfilUsuario),['class'=>'ace']) !!}
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{!! $perfil->no_perfil !!} </td>
                            <td>{!! $perfil->sistema->no_sistema !!} </td>
                            <td>
                                @foreach($perfilService->getItensMenu($perfil->id_perfil) as $itemMenu)
                                    <span class="label label-sm label-success arrowed"> {!! $itemMenu->no_item_menu !!} </span>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach

                @endforeach
            </tbody>
        </table>

        <br>

        {!! Form::submit('Alterar', ['class'=>'btn btn-sm btn-primary']) !!}
        <a href="{{route('sisadm::usuarios.index')}}" class="btn btn-large btn-sm btn-danger">Voltar</a>

        {!! Form::close() !!}
        

    </div>

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
                  { "bSortable": false },
                  { "bSortable": false },
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
        //$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
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