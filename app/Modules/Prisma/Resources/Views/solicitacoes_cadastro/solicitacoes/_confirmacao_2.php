<div class="row">
    <div class="col-md-4">
        <h4 class="lighter green">Instituição</h4>
        <div><strong>CNPJ: </strong><span id="confirmacao_nr_cnpj"> {{ $solicitacaoCadastro->nr_cnpj }}</span></div>
        <div><strong>Nome empresarial: </strong><span id="confirmacao_no_razao_social"> {{ $solicitacaoCadastro->no_razao_social }}</span></div>
        <div><strong>Nome relatório: </strong><span id="confirmacao_no_relatorio"> {{ $solicitacaoCadastro->no_relatorio }}</span></div>
        <div><strong>Situação cadastral: </strong><span id="confirmacao_no_situacao"> {{ $solicitacaoCadastro->no_situacao }}</span></div>
        <div><strong>Telefone: </strong><span id="confirmacao_nr_telefone"> {{ $solicitacaoCadastro->nr_telefone }}</span></div>
        <div><strong>E-mail: </strong><span id="confirmacao_ds_email"> {{ $solicitacaoCadastro->ds_email }}</span></div>
        <div><strong>Logradouro: </strong><span id="confirmacao_ed_logradouro"> {{ $solicitacaoCadastro->ed_logradouro }}</span></div>
        <div><strong>Número: </strong><span id="confirmacao_ed_numero_logradouro"> {{ $solicitacaoCadastro->ed_numero_logradouro }}</span></div>
        <div><strong>Complemento: </strong><span id="confirmacao_ed_complemento_logradouro"> {{ $solicitacaoCadastro->ed_complemento_complemento }}</span></div>
        <div><strong>CEP: </strong><span id="confirmacao_ed_cep_logradouro"> {{ $solicitacaoCadastro->ed_cep_logradouro }}</span></div>
        <div><strong>Bairro: </strong><span id="confirmacao_ed_bairro_logradouro"> {{ $solicitacaoCadastro->ed_bairro_logradouro }}</span></div>
        <div><strong>Município: </strong><span id="confirmacao_ed_municipio_logradouro"> {{ $solicitacaoCadastro->ed_municipio_logradouro }}</span></div>
        <div><strong>UF: </strong><span id="confirmacao_ed_sigla_uf"></span> {{ $solicitacaoCadastro->ed_sigla_uf }}</div>
    </div>

    <div class="col-md-4">
        <h4 class="lighter green">Responsável</h4>
        <div><strong>CPF: </strong><span id="confirmacao_nr_cpf_responsavel"> {{ $solicitacaoCadastro->nr_cpf_responsavel }} </span></div>
        <div><strong>Nome: </strong><span id="confirmacao_no_responsavel"> {{ $solicitacaoCadastro->no_responsavel }} </span></div>
        <div><strong>Telefone: </strong><span id="confirmacao_nr_telefone_responsavel"> {{ $solicitacaoCadastro->nr_telefone_responsavel }} </span></div>
        <div><strong>E-mail: </strong><span id="confirmacao_ds_email_responsavel"> {{ $solicitacaoCadastro->ds_email_responsavel }} </span></div>
        <div><strong>Cargo: </strong><span id="confirmacao_no_cargo_responsavel"> {{ $solicitacaoCadastro->no_cargo_responsavel }} </span></div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-md-8">
        <h4 class="lighter green">Editores</h4>

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