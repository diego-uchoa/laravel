<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('nr_cpf_responsavel', 'CPF:') !!}
            {!! Form::text('nr_cpf_responsavel', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf_responsavel']) !!}
        </div>
    </div>
    <div class="col-lg-10">
        <div class="form-group">
            {!! Form::label('no_responsavel', 'Nome:') !!}
            {!! Form::text('no_responsavel', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            {!! Form::label('nr_telefone_responsavel', 'Telefone:') !!}
            {!! Form::text('nr_telefone_responsavel', null, ['class'=>'form-control  input-mask-telefone']) !!}
        </div>
    </div>
    <div class="col-lg-5">
        <div class="form-group">
            {!! Form::label('ds_email_responsavel', 'E-mail:') !!}
            {!! Form::email('ds_email_responsavel', null, ['id' => 'ds_email_responsavel', 'class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-5">
        <div class="form-group">
            {!! Form::label('no_cargo_responsavel', 'Cargo:') !!}
            {!! Form::text('no_cargo_responsavel', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

@section('script-end')
    @parent


    <script type="text/javascript">        
    //     //Função responsável por recuperar dados do usuário no WS SIAPE através do CPF
    //     $(document).on('blur','#nr_cnpj', function() {

    //         var v_cnpj = $('#nr_cnpj').val().replace(/[^\d]+/g,'');
    //         var url = "{{ url('prisma/solicitar-cadastro/instituicao/dados/') }}" + "/" + v_cnpj;

    //         if (v_cnpj.length == 14)
    //         {
    //             $.ajax({
    //                 url: url,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 contentType: false, 
    //                 processData: false,
                    
    //                 beforeSend: function() {
    //                     dialogCreate = bootbox.dialog({
    //                         message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
    //                         closeButton: true
    //                     });
    //                 },
    //                 success: function(data) {
    //                     dialogCreate.init(function(){
                            
    //                         $('#formulario input[name=no_instituicao]').val(data.no_instituicao);
    //                         $('#formulario input[name=no_fantasia]').val(data.no_fantasia);
    //                         $('#formulario input[name=no_situacao]').val(data.no_situacao);
    //                         $('#formulario input[name=tx_telefone]').val(data.tx_telefone);
    //                         $('#formulario input[name=tx_email]').val(data.tx_email);
    //                         $('#formulario input[name=tx_logradouro]').val(data.tx_logradouro);
    //                         $('#formulario input[name=nr_logradouro]').val(data.nr_logradouro);
    //                         $('#formulario input[name=tx_complemento]').val(data.tx_complemento);
    //                         $('#formulario input[name=tx_cep]').val(data.tx_cep);
    //                         $('#formulario input[name=tx_bairro]').val(data.tx_bairro);
    //                         $('#formulario input[name=no_municipio]').val(data.no_municipio);
    //                         $('#formulario input[name=sg_uf]').val(data.sg_uf);                            


    //                         dialogCreate.modal('hide');
                            
    //                     });    
    //                 },
    //                 error: function(){
    //                     dialogCreate.modal('hide');
    //                 }
    //             });
    //         }    

    //     });

    //     //Habilitando o campo de órgão para o envio do formulário
    //     $(document).on('click','#btnFormSalvarAJAX', function() {
    //         $("#id_orgao").prop("disabled", false);
    //     });

    // </script>
@endsection