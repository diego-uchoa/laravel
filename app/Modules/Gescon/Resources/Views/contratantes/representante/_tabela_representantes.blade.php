<table id="dynamic-table-representante" class="table table-striped table-bordered table-hover">
    <thead>
        <th>CPF</th>
        <th>Nome</th>
        <th>Dt. Início</th>
        <th>Dt. Fim</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($contratante->representantes as $representante)
        	<tr>
                <td>{!! $representante->nr_cpf_representante !!}</td>
                <td>{!! $representante->no_representante !!}</td>
                <td>{!! $representante->dt_inicio !!}</td>
                <td>{!! $representante->dt_fim !!}</td>
                <td>
                	@if (!$representante->dt_fim)
	                	<a href="#" data-url="{{route('gescon::contratante_representante.edit',['id'=>$representante->id_contratante_representante, 'id_contratante' => $representante->id_contratante])}}" class="btn btn-xs btn-info update_representante" data-rel="tooltip" data-original-title="Alterar">
                            <i class="ace-icon fa fa-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-xs btn-danger modal_delete_representante" data-url="{{route('gescon::contratante_representante.modal_destroy_representante',['id'=>$representante->id_contratante_representante, 'id_contratante'=>$representante->id_contratante])}}" data-rel="tooltip" data-original-title="Desvincular">
	                        <i class="ace-icon fa fa-chain-broken"></i>
	                    </a>
	                @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>	