@if(!isset($id_proposicao))
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <th>Proposição</th>
            <th>Órgão</th>
            <th>Envio</th>
            <th>Tipo de consulta</th>
            <th>Comissão</th>
            <th>Prioridade</th>
            <th>Retorno</th>
            <th>Posição</th>
            <th>Status</th>
            <th>Ação</th>
        </thead>
    </table>
@else
    <table id="dynamic-table-consultas" class="table table-striped table-bordered table-hover">
        <thead>
            <th>Órgão</th>
            <th>Envio</th>
            <th>Tipo de consulta</th>
            <th>Comissão</th>
            <th>Prioridade</th>
            <th>Retorno</th>
            <th>Posição</th>
            <th>Status</th>
            <th>Ação</th>
        </thead>
        <tbody>
            @foreach($proposicao->consultas as $consultaMf)

                <tr>
                <td>{!! $consultaMf->orgao->sg_orgao !!}</td>
                <td>{!! $consultaMf->dt_envio !!}</td>
                <td>{!! $consultaMf->tipoConsulta->tx_tipo_consulta !!}</td>
                <td>{!! $consultaMf->no_comissao !!}</td>
                <td>{!! $consultaMf->nr_prioritario !!}</td>
                <td>{!! $consultaMf->dt_retorno !!}</td>
                <td>{!! $consultaMf->id_tipo_posicao ? $consultaMf->tipoPosicao->tx_tipo_posicao : '' !!}</td>
                <td>
                    @if($consultaMf->status == 'C')
                        <span class="label label-success">Concluído</span>
                    @elseif($consultaMf->status == 'P')
                        <span class="label label-info">Pendente</span>
                    @elseif($consultaMf->status == 'A')
                        <span class="label label-danger">Atrasado</span>
                    @endif  
                </td>
                    
                    <td>
                        @permission('parla::consultasMf.edit')
                            <a href="#" data-url="{{route('parla::consultasMf.edit',['id'=>$consultaMf->id_consulta_mf,'id_proposicao'=>$consultaMf->id_proposicao])}}" class="btn btn-xs btn-info update" data-rel="tooltip" data-original-title="Editar">
                                <i class="ace-icon fa fa-pencil"></i>
                            </a>
                        @endpermission
                        
                        @permission('parla::consultasMf.destroy')
                            <a href="#" data-id="{{ $consultaMf->id_consulta_mf }}" class="btn btn-xs btn-danger delete_parla" data-url="{{route('parla::consultasMf.destroy',['id'=>$consultaMf->id_consulta_mf,'id_proposicao'=>$consultaMf->id_proposicao])}}" data-rel="tooltip" data-original-title="Excluir">
                                <i class="ace-icon fa fa-trash-o"></i>
                            </a>
                        @endpermission
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif