<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Sigla</th>
        <th>Descrição</th>
        <th>Casa (Origem)</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($tiposProposicao as $tipoProposicao)

            <tr>
                <td>{!! $tipoProposicao->sg_tipo_proposicao !!}</td>
            <td>{!! $tipoProposicao->tx_tipo_proposicao !!}</td>
            <td>{!! $tipoProposicao->sg_casa_origem() !!}</td>
                
                <td>

                    <a href="#" data-url="{{route('parla::tiposProposicao.edit',['id'=>$tipoProposicao->id_tipo_proposicao])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $tipoProposicao->id_tipo_proposicao }}" class="btn btn-xs btn-danger delete" data-url="{{route('parla::tiposProposicao.destroy',['id'=>$tipoProposicao->id_tipo_proposicao])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>