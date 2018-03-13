<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Instituição vinculada</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($instituicoesResponsavelPrevisao as $instituicaoResponsavelPrevisao)

            <tr>
                <td>{!! $instituicaoResponsavelPrevisao->no_instituicao_responsavel_previsao !!}</td>
                <td>{!! optional($instituicaoResponsavelPrevisao->instituicao)->nr_cnpj." - ".optional($instituicaoResponsavelPrevisao->instituicao)->no_razao_social !!}</td>
                
                <td>

                    <a href="#" data-url="{{route('prisma::instituicoes_responsavel_previsao.edit',['id'=>$instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao }}" class="btn btn-xs btn-danger delete" data-url="{{route('prisma::instituicoes_responsavel_previsao.destroy',['id'=>$instituicaoResponsavelPrevisao->id_instituicao_responsavel_previsao])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>