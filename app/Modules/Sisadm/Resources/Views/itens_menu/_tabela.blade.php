<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <th>Nome</th>
        <th>Rota</th>
        <th>Ordem</th>            
        <th>Sistema</th>
        <th>Ação</th>
    </thead>
    <tbody>
        @foreach($itensMenu as $itemMenu)
            <tr id="item{{$itemMenu->id_item_menu}}">
                <td>{{$itemMenu->no_item_menu}}</td>
                <td>{{$itemMenu->rota}}</td>
                <td>{{$itemMenu->ordem}}</td>                    
                <td>{{$itemMenu->sistema->no_sistema}}</td>
                <td>
                    
                    <a href="{{route('sisadm::itens_menu.edit',['id'=>$itemMenu->id_item_menu])}}" class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                    
                    <a href="#" data-id="{{ $itemMenu->id_item_menu }}" class="btn btn-xs btn-danger delete" data-url="{{route('sisadm::itens_menu.destroy',['id'=>$itemMenu->id_item_menu])}}">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>    

                </td>
            </tr>
        @endforeach
    </tbody>
</table>