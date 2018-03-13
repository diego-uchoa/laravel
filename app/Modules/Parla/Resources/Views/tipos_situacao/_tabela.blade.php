<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Código na Casa</th>
        <th>Descrição</th>
        <th>Casa</th>
        <th>Status</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($tiposSituacao as $tipoSituacao)

            <tr>
                <td>{!! $tipoSituacao->co_tipo_situacao !!}</td>
            <td>{!! $tipoSituacao->tx_tipo_situacao !!}</td>
            <td>{!! $tipoSituacao->sg_casa_situacao() !!}</td>
            <td>{!! $tipoSituacao->sg_status_situacao() !!}</td>
                
                <td>

                    <a href="#" data-url="{{route('parla::tipos_situacao.edit',['id'=>$tipoSituacao->id_tipo_situacao])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $tipoSituacao->id_tipo_situacao }}" class="btn btn-xs btn-danger delete" data-url="{{route('parla::tipos_situacao.destroy',['id'=>$tipoSituacao->id_tipo_situacao])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>