<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Sigla</th>
        <th>Nome</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($orgaos as $orgao)
            <tr>
                <td>{{$orgao->sg_orgao}}</td>
                <td>{{$orgao->no_orgao}}</td> 
                <td>                
                    <a href="#" data-id="{{ $sistema->id_sistema }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::sistemas.orgaos.destroy',['id_sistema'=>$sistema->id_sistema,'id_orgao'=>$orgao->id_orgao])}}" data-rel="tooltip" data-original-title="Desvincular órgão">
                        <i class="ace-icon fa fa-remove"></i>
                    </a>    

                </td>                    
                
            </tr>
        @endforeach
    </tbody>
</table>