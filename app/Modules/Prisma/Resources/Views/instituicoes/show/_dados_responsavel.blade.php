<div class="widget-box widget-color-navy" id="dados-responsavel-widget">
    <div class="widget-header">
        <h5 class="widget-title"><i class="ace-icon fa fa-user"></i> Responsável</h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            @if(!empty($instituicao->responsavel->last()))
                <div class="profile-user-info">
                    <div class="profile-info-name">CPF</div>
                    <div class="profile-info-value">
                        <span>{{ $instituicao->responsavel->last()->nr_cpf }}</span>
                    </div>
                </div>

                <div class="profile-user-info">
                    <div class="profile-info-name">Nome</div>
                    <div class="profile-info-value">
                        <span>{{ $instituicao->responsavel->last()->no_usuario }}</span>
                    </div>
                </div>

                <div class="profile-user-info">
                    <div class="profile-info-name">Telefone</div>
                    <div class="profile-info-value">
                        <span>{{ $instituicao->responsavel->last()->pivot->nr_telefone }}</span>
                    </div>
                </div>

                <div class="profile-user-info">
                    <div class="profile-info-name">E-mail</div>
                    <div class="profile-info-value">
                        <span>{{ $instituicao->responsavel->last()->email }}</span>
                    </div>
                </div>

                <div class="profile-user-info">
                    <div class="profile-info-name">Cargo</div>
                    <div class="profile-info-value">
                        <span>{{ $instituicao->responsavel->last()->pivot->no_cargo }}</span>
                    </div>
                </div>

                <br>
                @permission('prisma::usuarios.edit.responsavel')
                    <a href='#' data-url="{{route('prisma::usuarios.edit.responsavel',['id'=>$instituicao->responsavel->last()->id_usuario])}}" class="btn btn-large btn-sm btn-warning update_prisma" data-rel='tooltip' data-original-title='Alterar dados do responsável atual.'>
                        <i class="ace-icon fa fa-pencil bigger-110"></i>Editar dados
                    </a>
                @endpermission

                @permission('prisma::usuarios.change.responsavel')
                    <a href='#' data-url="{{route('prisma::usuarios.change.responsavel',['id'=>$instituicao->responsavel->last()->id_usuario])}}" class="btn btn-large btn-sm btn-primary insert" data-rel='tooltip' data-original-title='Trocar o responsável atual por um novo. O atual responsável será removido do Prisma.'>
                        <i class="ace-icon fa fa-exchange bigger-110"></i>Substituir responsável
                    </a>
                @endpermission

                @permission('prisma::usuarios.destroy.responsavel')
                    <a href='#' data-id='$instituicao->responsavel->last()->id_usuario' data-url="{{route('prisma::usuarios.destroy.responsavel',['id'=>$instituicao->responsavel->last()->id_usuario])}}" class='btn btn-large btn-sm btn-danger delete_prisma' data-rel='tooltip' data-original-title='Remove o atual responsável sem adicionar um novo, inativando a instituição no Prisma.'>
                        <i class="ace-icon fa fa-times bigger-110"></i>Remover responsável
                    </a>
                @endpermission
            @else
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>
                    <p>
                        <strong>
                            <i class="ace-icon fa fa-times"></i>
                            Instituição {{ $instituicao->no_razao_social }} inativa!
                        </strong>
                        <br>
                        A instituição está inativa, pois não possui responsável cadastrado.
                    </p>
                </div>
                <br>
                @permission('prisma::usuarios.create.responsavel')
                    <a href="#" class="btn btn-large btn-sm btn-success insert" data-url="{{route('prisma::usuarios.create.responsavel',['id'=>$instituicao->id_instituicao])}}" data-rel='tooltip' data-original-title='Adicionar um novo responsável pela instituição.'>
                        <i class="ace-icon fa fa-plus bigger-110"></i>Adicionar responsável
                    </a>
                @endpermission
            @endif

        </div>
    </div>
</div>