<table id="dynamic-table-assinante" class="table table-striped table-bordered table-hover">
    <thead>
        <th>CPF</th>
        <th>Nome</th>
        <th>Função</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($contratante->contratanteAssinantes as $contratanteAssinante)
    	    <tr>
                <td>{!! $contratanteAssinante->nr_cpf_assinante !!}</td>
                <td>{!! $contratanteAssinante->no_assinante !!}</td>
                <td>{!! $contratanteAssinante->ds_funcao_assinante !!}</td>
                <td>
                    <a href="#" data-url="{{route('gescon::contratante_assinante.edit',['id'=>$contratanteAssinante->id_contratante_assinante, 'id_contratante' => $contratanteAssinante->id_contratante])}}" class="btn btn-xs btn-info update_assinante" data-rel="tooltip" data-original-title="Alterar">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                	<a href="#" data-id="{{ $contratanteAssinante->id_contratante_assinante }}" class="btn btn-xs btn-danger delete_assinante" data-url="{{route('gescon::contratante_assinante.destroy_assinante',['id'=>$contratanteAssinante->id_contratante_assinante, 'id_contratante'=>$contratanteAssinante->id_contratante])}}" data-rel="tooltip" data-original-title="Excluir">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>	