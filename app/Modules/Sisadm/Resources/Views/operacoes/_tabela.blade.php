<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Sistema</th>            
        <th>Favorita</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($operacoes as $operacao)
            <tr>
                <td>{{$operacao->no_operacao}}</td>
                <td>{{$operacao->ds_operacao}}</td> 
                <td>{{$operacao->sistema->no_sistema}}</td>                   
                <td>
                    @if($operacao->sn_favorita) 
                        Favorita
                    @else
                        -
                    @endif
                </td> 
                <td>

                    <a href="#" data-url="{{route('sisadm::operacoes.edit',['id'=>$operacao->id_operacao])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $operacao->id_operacao }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::operacoes.destroy',['id'=>$operacao->id_operacao])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>