<div class="widget-box widget-color-navy" id="dados-instituicao-responsavel-previsao-widget">
    <div class="widget-header">
        <h5 class="widget-title"><i class="ace-icon fa fa-link"></i> Instituição responsável pela previsão <strong><i class="ace-icon fa fa-question-circle" data-rel='tooltip' data-original-title='A “Instituição Responsável pelas Previsões” é utilizada para vincular a instituição que irá representá-la no cadastro das previsões.'></i></strong></h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            @if(isset($instituicao->instituicaoPrevisao))
                <div class="profile-user-info">
                    <div class="profile-info-name">Nome</div>
                    <div class="profile-info-value">
                        <span>{{ $instituicao->instituicaoPrevisao->no_instituicao_responsavel_previsao }}</span>
                    </div>
                </div>
                <br>
                @permission('prisma::instituicoes.edit.instituicao_responsavel_previsao')
                    <a href='#' data-url="{{route('prisma::instituicoes.edit.instituicao_responsavel_previsao',['id'=>$instituicao->id_instituicao])}}" class="btn btn-large btn-sm btn-primary update_prisma" data-rel='tooltip' data-original-title='Trocar “Instituição Responsável pelas Previsões” por outra previamente cadastrada e disponível.'>
                        <i class="ace-icon fa fa-exchange bigger-110"></i>Alterar instituição
                    </a>
                @endpermission

                @permission('prisma::instituicoes.destroy.instituicao_responsavel_previsao')
                    <a href='#' data-id="0" data-url="{{route('prisma::instituicoes.destroy.instituicao_responsavel_previsao',['id'=>$instituicao->id_instituicao])}}" class="btn btn-large btn-sm btn-danger delete_prisma" data-rel='tooltip' data-original-title='Excluir “Instituição Responsável pelas Previsões”, inativando a instituição.'>
                        <i class="ace-icon fa fa-times bigger-110"></i>Excluir vínculo
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
                        A instituição está inativa, pois o vínculo com a instituição responsável pela previsão foi excluído.
                    </p>
                </div>
                <br>
                @permission('prisma::instituicoes.edit.instituicao_responsavel_previsao')
                    <a href='#' data-url="{{route('prisma::instituicoes.edit.instituicao_responsavel_previsao',['id'=>$instituicao->id_instituicao])}}" class="btn btn-large btn-sm btn-success update_prisma" data-rel='tooltip' data-original-title='Adicionar uma “Instituição Responsável pelas Previsões” previamente cadastrada e disponível.'>
                        <i class="ace-icon fa fa-plus bigger-110"></i>Adicionar instituição
                    </a>
                @endpermission
            @endif
        </div>
    </div>
</div>