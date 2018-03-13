<div class="widget-box widget-color-navy" id="dados-editores-widget">
    <div class="widget-header">
        <h5 class="widget-title"><i class="ace-icon fa fa-users"></i> Editores</h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            @permission('prisma::usuarios.create.editor')
                <a href="#" class="btn btn-sm btn-success insert" data-url="{{route('prisma::usuarios.create.editor',['id'=>$instituicao->id_instituicao])}}" data-rel='tooltip' data-original-title='Adiciona um novo editor da instituição.'>
                    <i class="ace-icon fa fa-plus bigger-110"></i>
                    Adicionar editor
                </a>
                <br><br>
            @endpermission
            <table class="table table-striped table-bordered table-hover" id="confirmacao_editores">
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
                @foreach($instituicao->editores as $editor)
                    <tr>
                        <td>{{ $editor->nr_cpf }}</td>
                        <td>{{ $editor->no_usuario }}</td>
                        <td>{{ $editor->pivot->nr_telefone }}</td>
                        <td>{{ $editor->email }}</td>
                        <td>
                            @permission('prisma::usuarios.edit.editor')
                                <a href='#' data-url="{{route('prisma::usuarios.edit.editor',['id'=>$editor->id_usuario])}}" class='btn btn-xs btn-info update_prisma' data-rel='tooltip' data-original-title='Alterar os dados do editor.'>
                                    <i class='ace-icon fa fa-pencil'></i>
                                </a>
                            @endpermission

                            @permission('prisma::usuarios.destroy.editor')
                                <a href='#' data-id='{{ $editor->id_usuario }}' data-url="{{route('prisma::usuarios.destroy.editor',['id'=>$editor->id_usuario])}}" class='btn btn-xs btn-danger delete_prisma' data-rel='tooltip' data-original-title='Exclui o editor, removendo-o do Prisma.'>
                                    <i class='ace-icon fa fa-trash-o'></i>
                                </a>
                            @endpermission
                        </td>
                    </tr>
                @endforeach    
            </table>
        </div>
    </div>
</div>