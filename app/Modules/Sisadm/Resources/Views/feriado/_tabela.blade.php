<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Data</th>  
        <th>Fim de Semana</th>            
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($feriados as $feriado)

            <tr>
                <td>{{$feriado->no_feriado}}</td>
                <td>{{$feriado->dt_feriado}}</td> 
                <td>
                    @if($feriado->sn_fim_semana)
                        Fim de Semana
                    @else
                        -
                    @endif
                </td>                   
                
                <td>

                    <a href="#" data-url="{{route('sisadm::feriado.edit',['id'=>$feriado->id_feriado])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $feriado->id_feriado }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::feriado.destroy',['id'=>$feriado->id_feriado])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>