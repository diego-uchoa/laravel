@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::perfis.operacoes', $perfil) !!}

@endsection

@section('content')

        @section('page-header')
            Operações do Perfil
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                {{$perfil->no_perfil}}
            </small>
        @endsection

                
        {!! Form::open(['route'=>['sisadm::perfis.operacoes.store', $perfil->id_perfil]]) !!}
            
            
            <table id="dynamic-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>Operação</th>
                        <th>Sistema</th>
                    </tr>
                </thead>

                <tbody>
                    @php ($sistemaOperacao = '')
                    @foreach($operacoes as $operacao)

                    @if($operacao->sistema->no_sistema != $sistemaOperacao || $sistemaOperacao == '')
                        
                        <tr>
                            <td style="background-color: #DDD"></td> 
                            <th style="background-color: #DDD" class="center">
                                {!! $operacao->sistema->no_sistema !!}
                            </th>
                            <td style="background-color: #DDD"></td>
                        </tr>
        
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    {!! Form::checkbox("operacoes[]", $operacao->id_operacao, in_array($operacao->id_operacao,$operacoesPerfil),['class'=>'ace']) !!}
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{!! $operacao->ds_operacao !!} </td>
                            <td>{!! $operacao->sistema->no_sistema !!} </td>
                        </tr>
                    @else
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    {!! Form::checkbox("operacoes[]", $operacao->id_operacao, in_array($operacao->id_operacao,$operacoesPerfil),['class'=>'ace']) !!}
                                    <span class="lbl"></span>
                                </label>
                            </td>
                            <td>{!! $operacao->ds_operacao !!}</td>
                            <td>{!! $operacao->sistema->no_sistema !!} </td>
                        </tr>
                    @endif

                    
                    
                    @php ($sistemaOperacao = $operacao->sistema->no_sistema)
                    @endforeach
                </tbody>
            </table>


            <br>

            {!! Form::submit('Salvar', ['class'=>'btn btn-sm btn-primary']) !!}
            <a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>

        {!! Form::close() !!}


    
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