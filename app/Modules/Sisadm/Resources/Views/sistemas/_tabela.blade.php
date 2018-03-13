<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Área</th>
        <th>Ativo</th>
        <th>Tela Inicial</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($sistemas as $sistema)
            <tr>
                <td>{{$sistema->no_sistema}}</td>
                <td>{{$sistema->ds_sistema}}</td>
                <td>{{$sistema->area->no_area}}</td>
                <td>
                    @if($sistema->sn_ativo)
                        Ativo
                    @else
                        -
                    @endif
                </td> 
                <td>
                    @if($sistema->sn_tela_inicial)
                        Tela Inicial
                    @else
                        -
                    @endif
                </td>                    
                <td>
                    <a href="{{route('sisadm::sistemas.orgaos',['id'=>$sistema->id_sistema])}}" class="btn btn-xs btn-default" data-rel="tooltip" data-original-title="Definir órgãos utilizados pelo sistema">
                        Órgãos
                    </a> 

                    <a href="{{route('sisadm::sistemas.edit',['id'=>$sistema->id_sistema])}}" class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                
                    <a href="#" data-id="{{ $sistema->id_sistema }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::sistemas.destroy',['id'=>$sistema->id_sistema])}}">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>    

                </td>
            </tr>
        @endforeach
    </tbody>
</table>