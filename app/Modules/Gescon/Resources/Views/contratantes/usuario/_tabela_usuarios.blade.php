<table id="dynamic-table-usuario" class="table table-striped table-bordered table-hover">
    <thead>
        <th>CPF</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($contratante->contratanteUsuarios as $contratanteUsuario)
    	    <tr>
                <td>{!! $contratanteUsuario->usuario->nr_cpf !!}</td>
                <td>{!! $contratanteUsuario->usuario->no_usuario !!}</td>
                <td>{!! $contratanteUsuario->usuario->email !!}</td>
                <td>
                	<a href="#" data-id="{{ $contratanteUsuario->id_contratante_usuario }}" class="btn btn-xs btn-danger delete_usuario" data-url="{{route('gescon::contratante_usuario.destroy_usuario',['id'=>$contratanteUsuario->id_contratante_usuario, 'id_contratante'=>$contratanteUsuario->id_contratante])}}" data-rel="tooltip" data-original-title="Excluir">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>	