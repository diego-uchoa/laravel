<div class="row">
    <div class="col-xs-12 col-sm-5">
            <div class="widget-box widget-color-navy">
                <div class="widget-header">
                    <h5 class="widget-title"><i class="ace-icon fa fa-university"></i> Instituição</h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">CNPJ</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->nr_cnpj }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Nome em Relatórios</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->no_relatorio }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Nome empresarial</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->no_razao_social }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Situação cadastral</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->no_situacao }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Telefone</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->nr_telefone }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">E-mail</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ds_email }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Logradouro</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_logradouro }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Número</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_numero_logradouro }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Complemento</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_complemento_complemento }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">CEP</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_cep_logradouro }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Bairro</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_bairro_logradouro }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">Município</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_municipio_logradouro }}</span>
                            </div>
                        </div>

                        <div class="profile-instituicao-info" style="height: 20px;">
                            <div class="profile-instituicao-name">UF</div>
                            <div class="profile-instituicao-value">
                                <span>{{ $solicitacaoCadastro->ed_sigla_uf }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-7">
            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box widget-color-navy">
                        <div class="widget-header">
                            <h5 class="widget-title"><i class="ace-icon fa fa-user"></i> Responsável <strong></strong></h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="profile-instituicao-info" style="height: 20px;">
                                    <div class="profile-instituicao-responsavel-name">CPF</div>
                                    <div class="profile-instituicao-value">
                                        <span>{{ $solicitacaoCadastro->nr_cpf_responsavel }}</span>
                                    </div>
                                </div>

                                <div class="profile-instituicao-info" style="height: 20px;">
                                    <div class="profile-instituicao-responsavel-name">Nome</div>
                                    <div class="profile-instituicao-value">
                                        <span>{{ $solicitacaoCadastro->no_responsavel }}</span>
                                    </div>
                                </div>

                                <div class="profile-instituicao-info" style="height: 20px;">
                                    <div class="profile-instituicao-responsavel-name">Telefone</div>
                                    <div class="profile-instituicao-value">
                                        <span>{{ $solicitacaoCadastro->nr_telefone_responsavel }}</span>
                                    </div>
                                </div>

                                <div class="profile-instituicao-info" style="height: 20px;">
                                    <div class="profile-instituicao-responsavel-name">E-mail</div>
                                    <div class="profile-instituicao-value">
                                        <span>{{ $solicitacaoCadastro->ds_email_responsavel }}</span>
                                    </div>
                                </div>

                                <div class="profile-instituicao-info" style="height: 20px;">
                                    <div class="profile-instituicao-responsavel-name">Cargo</div>
                                    <div class="profile-instituicao-value">
                                        <span>{{ $solicitacaoCadastro->no_cargo_responsavel }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-7"></div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box widget-color-navy">
                        <div class="widget-header">
                            <h5 class="widget-title"><i class="ace-icon fa fa-users"></i> Editores</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">

                                <table class="table table-striped table-bordered table-hover" id="confirmacao_editores">
                                    <tr><th>CPF</th><th>Nome</th><th>Telefone</th><th>E-mail</th></tr>
                                    @foreach($solicitacaoCadastro->editores as $editor)
                                        <tr>
                                            <td>{{ $editor->nr_cpf }}</td>
                                            <td>{{ $editor->no_editor }}</td>
                                            <td>{{ $editor->nr_telefone }}</td>
                                            <td>{{ $editor->ds_email }}</td>
                                        </tr>
                                    @endforeach    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>

</div>
<div class="hr hr-18 dotted hr-double"></div>