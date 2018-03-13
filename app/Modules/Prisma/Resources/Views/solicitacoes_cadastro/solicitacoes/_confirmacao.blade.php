<br>
<h4 class="lighter green">Instituição</h4>
<div><strong>CNPJ: </strong><span id="confirmacao_nr_cnpj"></span></div>
<div><strong>Nome empresarial: </strong><span id="confirmacao_no_razao_social"></span></div>
<div><strong>Nome relatório: </strong><span id="confirmacao_no_relatorio"></span></div>
<div><strong>Situação cadastral: </strong><span id="confirmacao_no_situacao"></span></div>
<div><strong>Telefone: </strong><span id="confirmacao_nr_telefone"></span></div>
<div><strong>E-mail: </strong><span id="confirmacao_ds_email"></span></div>
<div><strong>Logradouro: </strong><span id="confirmacao_ed_logradouro"></span></div>
<div><strong>Número: </strong><span id="confirmacao_ed_numero_logradouro"></span></div>
<div><strong>Complemento: </strong><span id="confirmacao_ed_complemento_logradouro"></span></div>
<div><strong>CEP: </strong><span id="confirmacao_ed_cep_logradouro"></span></div>
<div><strong>Bairro: </strong><span id="confirmacao_ed_bairro_logradouro"></span></div>
<div><strong>Município: </strong><span id="confirmacao_ed_municipio_logradouro"></span></div>
<div><strong>UF: </strong><span id="confirmacao_ed_sigla_uf"></span></div>

<br>
<br>
<h4 class="lighter green">Responsável</h4>
<div><strong>CPF: </strong><span id="confirmacao_nr_cpf_responsavel"></span></div>
<div><strong>Nome: </strong><span id="confirmacao_no_responsavel"></span></div>
<div><strong>Telefone: </strong><span id="confirmacao_nr_telefone_responsavel"></span></div>
<div><strong>E-mail: </strong><span id="confirmacao_ds_email_responsavel"></span></div>
<div><strong>Cargo: </strong><span id="confirmacao_no_cargo_responsavel"></span></div>

<br>
<br>
<h4 class="lighter green">Editores</h4>

<table class="table table-striped table-bordered table-hover" id="confirmacao_editores">

</table>

@section('script-end')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){  
        	$('#fuelux-wizard-container').on('changed.fu.wizard', function(evt, item) {
        	    if(item.step == 4) {
        	    	//INSTITUICAO
        	    	$('#confirmacao_nr_cnpj').empty();
        	    	$('#confirmacao_nr_cnpj').append($('#formulario input[name=nr_cnpj]').val());
        	    
        	    	$('#confirmacao_no_razao_social').empty();
        	    	$('#confirmacao_no_razao_social').append($('#formulario input[name=no_razao_social]').val());
        	    	
        	    	$('#confirmacao_no_relatorio').empty();
        	    	$('#confirmacao_no_relatorio').append($('#formulario input[name=no_relatorio]').val());

        	    	$('#confirmacao_no_situacao').empty();
        	    	$('#confirmacao_no_situacao').append($('#formulario input[name=no_situacao]').val());

        	    	$('#confirmacao_nr_telefone').empty();
        	    	$('#confirmacao_nr_telefone').append($('#formulario input[name=nr_telefone]').val());

        	    	$('#confirmacao_ds_email').empty();
        	    	$('#confirmacao_ds_email').append($('#formulario input[name=ds_email]').val());

        	    	$('#confirmacao_ed_logradouro').empty();
        	    	$('#confirmacao_ed_logradouro').append($('#formulario input[name=ed_logradouro]').val());

        	    	$('#confirmacao_ed_numero_logradouro').empty();
        	    	$('#confirmacao_ed_numero_logradouro').append($('#formulario input[name=ed_numero_logradouro]').val());

        	    	$('#confirmacao_ed_complemento_complemento').empty();
        	    	$('#confirmacao_ed_complemento_complemento').append($('#formulario input[name=ed_complemento_complemento]').val());

        	    	$('#confirmacao_ed_cep_logradouro').empty();
        	    	$('#confirmacao_ed_cep_logradouro').append($('#formulario input[name=ed_cep_logradouro]').val());

        	    	$('#confirmacao_ed_bairro_logradouro').empty();
        	    	$('#confirmacao_ed_bairro_logradouro').append($('#formulario input[name=ed_bairro_logradouro]').val());

        	    	$('#confirmacao_ed_municipio_logradouro').empty();
        	    	$('#confirmacao_ed_municipio_logradouro').append($('#formulario input[name=ed_municipio_logradouro]').val());

        	    	$('#confirmacao_ed_sigla_uf').empty();
        	    	$('#confirmacao_ed_sigla_uf').append($('#formulario input[name=ed_sigla_uf]').val());

        	    	//RESPONSAVEL
        	    	$('#confirmacao_nr_cpf_responsavel').empty();
        	    	$('#confirmacao_nr_cpf_responsavel').append($('#formulario input[name=nr_cpf_responsavel]').val());
        	    	
        	    	$('#confirmacao_no_responsavel').empty();
        	    	$('#confirmacao_no_responsavel').append($('#formulario input[name=no_responsavel]').val());

        	    	$('#confirmacao_nr_telefone_responsavel').empty();
        	    	$('#confirmacao_nr_telefone_responsavel').append($('#formulario input[name=nr_telefone_responsavel]').val());

        	    	$('#confirmacao_ds_email_responsavel').empty();
        	    	$('#confirmacao_ds_email_responsavel').append($('#formulario input[name=ds_email_responsavel]').val());

        	    	$('#confirmacao_no_cargo_responsavel').empty();
        	    	$('#confirmacao_no_cargo_responsavel').append($('#formulario input[name=no_cargo_responsavel]').val());


                    $("#confirmacao_editores tbody").empty();

                    $("#confirmacao_editores").append("<tr><th>CPF</th><th>Nome</th><th>Telefone</th><th>E-mail</th></tr>");

                    $("input[name^='nr_cpf_editor_adicionada']").each(function (index) {
                       $("#confirmacao_editores").append("<tr id='row_"+ index +"'><td>"+ $(this).val() +"</td></tr>");
                       
                    });

                    $("input[name^='no_editor_adicionada']").each(function (index) {
                       $("#row_"+index).append("<td>"+ $(this).val() +"</td>");
                    });

                    $("input[name^='nr_telefone_editor_adicionada']").each(function (index) {
                       $("#row_"+index).append("<td>"+ $(this).val() +"</td>");
                    });

                    $("input[name^='ds_email_editor_adicionada']").each(function (index) {
                       $("#row_"+index).append("<td>"+ $(this).val() +"</td>");
                    });



        	    }
        	});  
        });  

    </script>
@endsection