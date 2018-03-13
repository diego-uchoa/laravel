<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Descrição</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($tiposPosicao as $tipoPosicao)

            <tr>
                <td>{!! $tipoPosicao->tx_tipo_posicao !!}</td>
                
                <td>

                    <a href="#" data-url="{{route('parla::tiposPosicao.edit',['id'=>$tipoPosicao->id_tipo_posicao])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $tipoPosicao->id_tipo_posicao }}" class="btn btn-xs btn-danger delete" data-url="{{route('parla::tiposPosicao.destroy',['id'=>$tipoPosicao->id_tipo_posicao])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>