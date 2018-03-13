<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Descrição</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($tiposConsulta as $tipoConsulta)

            <tr>
                <td>{!! $tipoConsulta->tx_tipo_consulta !!}</td>
                
                <td>

                    <a href="#" data-url="{{route('parla::tiposConsulta.edit',['id'=>$tipoConsulta->id_tipo_consulta])}}" class="btn btn-xs btn-info update">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>

                    <a href="#" data-id="{{ $tipoConsulta->id_tipo_consulta }}" class="btn btn-xs btn-danger delete" data-url="{{route('parla::tiposConsulta.destroy',['id'=>$tipoConsulta->id_tipo_consulta])}}" >
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>