<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Data Início</th>  
        <th>Data Fim</th>  
        <th>Todo Dia</th> 
        <th>Usuário</th> 
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($eventos as $evento)
            <tr>
                <td>{{$evento->no_evento}}</td>
                <td>{{$evento->ds_evento}}</td>
                <td>{{$evento->data_inicio}}</td> 
                <td>{{$evento->data_fim}}</td> 
                <td>
                    @if($evento->sn_todo_dia)
                        Todo Dia
                    @else
                        -
                    @endif
                </td>   
                <td>{{$evento->usuario->no_usuario}}</td>                
                
                <td>

                    <a href="#" data-url="{{route('sisadm::evento.edit',['id'=>$evento->id_evento])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $evento->id_evento }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::evento.destroy',['id'=>$evento->id_evento])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>

            </tr>
        @endforeach
    </tbody>
</table>