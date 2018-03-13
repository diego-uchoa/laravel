<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Sigla</th>
        <th>Nome</th>
        <th>Casa</th>
        <th>Tipo</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($comissoes as $comissao)

            <tr>
                <td>
                    @permission('parla::comissoes.show')
                        <a href="{{route('parla::comissoes.show',['id'=>$comissao->id_comissao])}}">{!! $comissao->sg_comissao !!}</a>
                    @else
                        {!! $comissao->sg_comissao !!}
                    @endpermission
                </td>
                <td>{!! $comissao->no_comissao !!}</td>
                <td>{!! $comissao->no_casa !!}</td>
                <td>{!! $comissao->in_tipo !!}</td>
                    
                <td>
                    @permission('parla::comissoes.show')
                        <a href="{{route('parla::comissoes.show',['id'=>$comissao->id_comissao])}}" class="btn btn-xs btn-success" data-rel="tooltip" data-original-title="Ver composição">
                            <i class="ace-icon fa fa-eye"></i>
                        </a>
                    @endpermission
                </td>
            </tr>
        @endforeach
    </tbody>
</table>