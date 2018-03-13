@if(!isset($id_proposicao))
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <th>Proposição</th>
            <th>Data</th>
            <th>Posição</th>
            <th>Órgão Destino</th>
            <th>Documento</th>
            <th>Descrição</th>
            <th>Ação</th>
        </thead>
    </table>
@else
    <table id="dynamic-table-respostas" class="table table-striped table-bordered table-hover">
        <thead>
            <th>Data</th>
            <th>Posição</th>
            <th>Órgão Destino</th>
            <th>Documento</th>
            <th>Descrição</th>
            <th>Ação</th>
        </thead>
        <tbody>
            @foreach($proposicao->respostas as $respostaMf)

                <tr>
                <td>{!! $respostaMf->dt_envio !!}</td>
                <td>{!! $respostaMf->id_tipo_posicao ? $respostaMf->tipoPosicao->tx_tipo_posicao : '' !!}</td>
                <td>{!! $respostaMf->orgao->sg_orgao !!}</td>
                <td>{!! $respostaMf->tx_arquivo ? '<a href="/uploads/parla/respostas/'.$respostaMf->tx_arquivo.'"><span><i class="fa fa-download" aria-hidden="true"></i> '.$respostaMf->no_documento.'</span></a>' : $respostaMf->no_documento !!}</td>
                <td>{!! $respostaMf->tx_descricao !!}</td>
                    
                    <td>
                        @permission('parla::respostas_mf.edit')
                            <a href="#" data-url="{{route('parla::respostas_mf.edit',['id'=>$respostaMf->id_resposta_mf,'id_proposicao'=>$respostaMf->id_proposicao])}}" class="btn btn-xs btn-info update" data-rel="tooltip" data-original-title="Editar">
                                <i class="ace-icon fa fa-pencil"></i>
                            </a>
                        @endpermission

                        @permission('parla::respostas_mf.destroy')
                            <a href="#" data-id="{{ $respostaMf->id_resposta_mf }}" class="btn btn-xs btn-danger delete_parla" data-url="{{route('parla::respostas_mf.destroy',['id'=>$respostaMf->id_resposta_mf,'id_proposicao'=>$respostaMf->id_proposicao])}}" data-rel="tooltip" data-original-title="Excluir">
                                <i class="ace-icon fa fa-trash-o"></i>
                            </a>
                        @endpermission

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif