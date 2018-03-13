<div class="form-group">
    {!! Form::label('cpf', 'CPF:') !!}
    <div class="input-group">
        {!! Form::text('nr_cpf', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf']) !!}
        <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button" id="bt_buscar_cpf">
                <i class="ace-icon fa fa-location-arrow bigger-110"></i>
                Buscar!
            </button>
        </span>
    </div>
</div>

<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('no_usuario', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('nr_telefone', 'Telefone:') !!}
{!! Form::text('nr_telefone', null, ['class'=>'form-control  input-mask-telefone']) !!}
</div>


@if(Auth::user()->hasPerfil('PRISMA-Gestor'))
<div class="form-group">
	{!! Form::label('instituicao', 'Instituição:') !!}
	{!! Form::select('id_instituicao', $instituicoes, null, ['class'=>'form-control', 'id' => 'id_instituicao']) !!}
</div>
@endif

@section('script-end')
    @parent

    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>

    <script type="text/javascript">
        
        //Função responsável por recuperar dados do usuário no WS SIAPE através do CPF
        $(document).on('click','#bt_buscar_cpf', function() {

            var v_cpf = $('#nr_cpf').val().replace(/[^\d]+/g,'');
            var url = "{{ url('portal/profile/dados/') }}" + "/" + v_cpf;

            if (v_cpf.length == 11)
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
                            
                            $('#formulario input[name=no_usuario]').val(data.nome);
                            $("#id_instituicao").select2("trigger", "select", {
                                data: { id: data.id_instituicao, text: data.no_razao_social}
                            });
                            $("#id_instituicao").prop("disabled", true);
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
        
        $('.input-mask-cpf').mask('999.999.999-99');

    </script>
@endsection

