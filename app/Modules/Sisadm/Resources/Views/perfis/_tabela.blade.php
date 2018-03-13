<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Operações</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($perfis as $perfil)
            <tr>
                <td>{{$perfil->no_perfil}}</td>
                <td>{{$perfil->ds_perfil}}</td>
                <td>
                    @foreach($perfil->operacoes as $operacao)
                        <span class="label label-sm label-danger arrowed"> {{$operacao->no_operacao}} </span>
                    @endforeach
                </td>
                <td>

                    <a href="{{route('sisadm::perfis.operacoes',['id'=>$perfil->id_perfil])}}" class="btn btn-xs btn-default">
                        Operações
                    </a>

                    <a href="#" data-url="{{route('sisadm::perfis.edit',['id'=>$perfil->id_perfil])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $perfil->id_perfil }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::perfis.destroy',['id'=>$perfil->id_perfil])}}">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>    

                </td>
            </tr>
        @endforeach
    </tbody>
</table>