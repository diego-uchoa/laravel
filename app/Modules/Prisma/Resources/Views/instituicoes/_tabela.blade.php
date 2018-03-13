<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>CNPJ</th>
        <th>Razão social</th>
        <th>Nome em relatórios</th>
        <th>Responsável</th>
        <th>Situação no Prisma</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($instituicoes as $instituicao)

            <tr>
                <td>{!! $instituicao->nr_cnpj !!}</td>
                <td>{!! $instituicao->no_razao_social !!}</td>
                <td>{!! $instituicao->no_relatorio !!}</td>
                <td>{!! optional($instituicao->responsavel->last())->no_usuario !!}</td>
                <td>{{ $instituicao->situacaoPrisma }}</td>
                <td>

                    <a href="{{route('prisma::instituicoes.show',['id'=>$instituicao->id_instituicao])}}" class="btn btn-xs btn-success" data-rel="tooltip" data-original-title="Gerenciar informações da instituição, responsável e editores.">
                        <i class="ace-icon fa fa-eye"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>