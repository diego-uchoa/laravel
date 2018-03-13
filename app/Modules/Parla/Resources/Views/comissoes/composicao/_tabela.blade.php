<table id="dynamic-table-composicao-comissao" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Partido/UF</th>
        <th>Cargo</th>
        <th>Posicionamento</th>
    </thead>
    <tbody>
        @foreach($comissao->membros->sortBy('no_parlamentar') as $membro)

            <tr>
                <td><a href="{{route('parla::parlamentares.show',['id'=>$membro->id_parlamentar])}}">{!! $membro->no_parlamentar !!}</a></td>
                <td>{!! $membro->partido_atual.'/'.$membro->sg_uf_parlamentar !!}</td>
                <td>{!! $membro->cargo_comissao !!}</td>
                <td>
                    @if($membro->sg_posicionamento_comissao == 'O')
                        <span class="label label-danger">
                    @elseif($membro->sg_posicionamento_comissao == 'B')
                        <span class="label label-success">
                    @elseif($membro->sg_posicionamento_comissao == 'I')
                        <span class="label label-default">
                    @endif
                    {{ $membro->posicionamento_comissao }}</span>
                    @permission('parla::comissoes.show.edit')
                        <a href="#" data-url="{{route('parla::comissoes.edit.posicionamento',['id_comissao'=>$comissao->id_comissao,'id_parlamentar'=>$membro->id_parlamentar, 'origin'=>'composicao'])}}" class="update_parla" data-rel="tooltip" data-original-title="Editar posicionamento na comissão"><i class="blue fa fa-pencil bigger-120"></i></a>
                    @endpermission
                </td>
            </tr>
        @endforeach
    </tbody>
</table>