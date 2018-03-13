<div class="widget-box widget-color-navy" id="dados-instituicao-widget">
    <div class="widget-header">
        <h5 class="widget-title"><i class="ace-icon fa fa-university"></i> Instituição</h5>
    </div>

    <div class="widget-body">
        <div class="widget-main">
            <div class="profile-user-info">
                <div class="profile-info-name">CNPJ</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->nr_cnpj }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Nome em relatórios <strong><i class="ace-icon fa fa-question-circle" data-rel='tooltip' data-original-title='Nome que a instituição quer que seja apresentado nos relatórios divulgados pelo PRISMA'></i></strong> </div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->no_relatorio }}</span>
                    <a href="#" data-url="{{route('prisma::instituicoes.edit.nome_relatorio',['id'=>$instituicao->id_instituicao])}}" class="update_prisma" data-rel="tooltip" data-original-title="Editar nome em relatórios"><i class="blue fa fa-pencil bigger-120"></i></a>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Nome empresarial</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->no_razao_social }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Situação cadastral</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->no_situacao }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Telefone</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->nr_telefone }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">E-mail</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ds_email }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Logradouro</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_logradouro }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Número</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_numero_logradouro }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Complemento</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_complemento_complemento }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">CEP</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_cep_logradouro }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Bairro</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_bairro_logradouro }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">Município</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_municipio_logradouro }}</span>
                </div>
            </div>

            <div class="profile-user-info">
                <div class="profile-info-name">UF</div>
                <div class="profile-info-value">
                    <span>{{ $instituicao->ed_sigla_uf }}</span>
                </div>
            </div>

        </div>
    </div>
</div>