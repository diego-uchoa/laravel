<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Texto</th>
        <th>Tipo Aviso</th>
        <th>Ordem</th>
        <th>Sistema</th>
        <th>Usuário</th>
        <th>Lido</th>
        <th>Data Leitura</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($avisos as $aviso)
            <tr>
                <td>{{$aviso->tx_aviso_usuario}}</td>
                <td>{{$aviso->tipo->no_tipo_aviso_usuario}}</td>
                <td>{{$aviso->nr_ordem}}</td>
                <td>
                    @if(isset($aviso->sistema->no_sistema))
                        {{$aviso->sistema->no_sistema}}
                    @endif
                </td>
                <td>{{$aviso->usuario->no_usuario}}</td>
                <td>
                    @if($aviso->sn_lido)
                        Lido
                    @else
                        -
                    @endif
                </td>
                <td>{{$aviso->dt_lido}}</td>

                <td>

                    <a href="#" data-url="{{route('sisadm::aviso_usuario.edit',['id'=>$aviso->id_aviso_usuario])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $aviso->id_aviso_usuario }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::aviso_usuario.destroy',['id'=>$aviso->id_aviso_usuario])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>