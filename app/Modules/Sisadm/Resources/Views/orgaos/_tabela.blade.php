<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Sigla</th>
        <th>Nome</th>
        <th>Município</th>
        <th>Uorg</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($orgaos as $orgao)

            <tr>
                <td>{!! $orgao->sg_orgao !!}</td>
                <td>{!! $orgao->no_orgao !!}</td>
                <td>{!! $orgao->municipio->no_municipio !!}</td>
                <td>{!! $orgao->co_uorg !!}</td>
                
                <td>

                    <a href="#" data-url="{{route('sisadm::orgaos.edit',['id'=>$orgao->id_orgao])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $orgao->id_orgao }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::orgaos.destroy',['id'=>$orgao->id_orgao])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>