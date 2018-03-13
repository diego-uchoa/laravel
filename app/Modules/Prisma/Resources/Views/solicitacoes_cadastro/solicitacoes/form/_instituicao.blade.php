<div class="form-group">
    {!! Form::label('cnpj', 'CNPJ:') !!}
    <div class="input-group">
        {!! Form::text('nr_cnpj', null, ['class'=>'form-control input-mask-cnpj', 'id' => 'nr_cnpj']) !!}
        <span class="input-group-btn">
            <button class="btn btn-sm btn-info" type="button" id="bt_buscar_cpf">
                <i class="ace-icon fa fa-refresh bigger-110"></i>
                Atualizar dados da instituição!
            </button>
        </span>
    </div>
</div>

<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <strong><i class="ace-icon fa fa-info-circle"></i></strong> Os dados abaixo são obtidos a partir do cadastro de pessoa jurídica na Receita Federal.
    <br />
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('no_relatorio', 'Nome da instituição em relatórios:') !!}
            <strong><i class="ace-icon fa fa-question-circle" data-rel='tooltip' data-original-title='Nome que a instituição quer que seja apresentado nos relatórios divulgados pelo PRISMA'></i></strong> 
            {!! Form::text('no_relatorio', null, ['class'=>'form-control', 'id' => 'no_relatorio']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('no_razao_social', 'Razão social:') !!}
            {!! Form::text('no_razao_social', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('no_situacao', 'Situação cadastral:') !!}
            {!! Form::text('no_situacao', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('nr_telefone', 'Telefone:') !!}
            {!! Form::text('nr_telefone', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('ds_email', 'E-mail:') !!}
            {!! Form::text('ds_email', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <div class="form-group">
            {!! Form::label('ed_logradouro', 'Logradouro:') !!}
            {!! Form::text('ed_logradouro', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-1">
        <div class="form-group">
            {!! Form::label('ed_numero_logradouro', 'Número:') !!}
            {!! Form::text('ed_numero_logradouro', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('ed_complemento_logradouro', 'Complemento:') !!}
            {!! Form::text('ed_complemento_logradouro', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('ed_cep_logradouro', 'CEP:') !!}
            {!! Form::text('ed_cep_logradouro', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('ed_bairro_logradouro', 'Bairro:') !!}
            {!! Form::text('ed_bairro_logradouro', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('ed_municipio_logradouro', 'Município:') !!}
            {!! Form::text('ed_municipio_logradouro', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('ed_sigla_uf', 'Estado:') !!}
            {!! Form::text('ed_sigla_uf', null, ['class'=>'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

@section('script-end')
    @parent

    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.cpfcnpj.js') }}"></script>
    
    <script type="text/javascript">        
        //Função responsável por recuperar dados do usuário no WS SIAPE através do CPF
        $(document).on('blur','#nr_cnpj', function() {

            var v_cnpj = $('#nr_cnpj').val().replace(/[^\d]+/g,'');
            var url = "{{ url('prisma/solicitar-cadastro/instituicao/dados/') }}" + "/" + v_cnpj;

            if (v_cnpj.length == 14)
            {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: false, 
                    processData: false,
                    
                    beforeSend: function() {
                        dialogCreate = bootbox.dialog({
                            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                            closeButton: true
                        });
                    },
                    success: function(data) {
                        dialogCreate.init(function(){
 
                            if(data.no_razao_social !== ''){
                                $('#formulario input[name=no_razao_social]').val(data.no_razao_social);
                            }

                            if(data.no_situacao !== ''){
                                $('#formulario input[name=no_situacao]').val(data.no_situacao);
                            }

                            if(data.nr_telefone !== ''){
                                $('#formulario input[name=nr_telefone]').val(data.nr_telefone);
                            }

                            if(data.ds_email !== ''){
                                $('#formulario input[name=ds_email]').val(data.ds_email);
                            }
                                
                            if(data.ed_logradouro !== ''){
                                $('#formulario input[name=ed_logradouro]').val(data.ed_logradouro);
                            }

                            if(data.ed_numero_logradouro !== ''){
                                $('#formulario input[name=ed_numero_logradouro]').val(data.ed_numero_logradouro);
                            }
                                
                            if(data.ed_complemento_logradouro !== ''){
                                $('#formulario input[name=ed_complemento_logradouro]').val(data.ed_complemento_logradouro);
                            }
                                
                            if(data.ed_cep_logradouro !== ''){
                                $('#formulario input[name=ed_cep_logradouro]').val(data.ed_cep_logradouro);
                            }

                            if(data.ed_bairro_logradouro !== ''){
                                $('#formulario input[name=ed_bairro_logradouro]').val(data.ed_bairro_logradouro);
                            }
                                
                            if(data.ed_municipio_logradouro !== ''){
                                $('#formulario input[name=ed_municipio_logradouro]').val(data.ed_municipio_logradouro);
                            }
                                
                            if(data.ed_sigla_uf !== ''){
                                $('#formulario input[name=ed_sigla_uf]').val(data.ed_sigla_uf);
                            }
                                
                            dialogCreate.modal('hide');
                            
                        });    
                    },
                    error: function(){
                        dialogCreate.modal('hide');
                    }
                });
            }    

        });

        //Habilitando o campo de órgão para o envio do formulário
        $(document).on('click','#btnFormSalvarAJAX', function() {
            $("#id_orgao").prop("disabled", false);
        });

        $(document).ready(function () {
            $('#nr_cpf_responsavel').cpfcnpj({
                mask: true,
                validate: 'cpf',
                event: 'blur',
                handler: '#nr_cpf_responsavel',
                ifValid: function (input) {},
                ifInvalid: function (input) { 
                    dialogCreate = bootbox.dialog({
                            message: '<p class="text-center">O nº de CPF informado é inválido, favor verificar.</p>',
                            closeButton: true
                    }); 
                }
            });    

            $('#nr_cpf_editor').cpfcnpj({
                mask: true,
                validate: 'cpf',
                event: 'blur',
                handler: '#nr_cpf_editor',
                ifValid: function (input) {},
                ifInvalid: function (input) { 
                    dialogCreate = bootbox.dialog({
                            message: '<p class="text-center">O nº de CPF informado é inválido, favor verificar.</p>',
                            closeButton: true
                    }); 
                }
            });    
        });

    </script>
@endsection