@if($mode == 'update')
    <div class="form-group">
        {!! Form::label('cpf', 'CPF:') !!}
        {!! Form::text('nr_cpf', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf', 'readonly']) !!}
    </div>
@else
    <div class="form-group">
        {!! Form::label('cpf', 'CPF:') !!}
        {!! Form::text('nr_cpf', null, ['class'=>'form-control input-mask-cpf', 'id' => 'nr_cpf']) !!}
    </div>
@endif

<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('no_usuario', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'E-mail:') !!}
    {!! Form::text('email', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
{!! Form::label('nr_telefone', 'Telefone:') !!}
{!! Form::text('nr_telefone', null, ['class'=>'form-control  input-mask-telefone']) !!}
</div>


@if(Auth::user()->hasPerfil('PRISMA-Gestor'))
<div class="form-group">
	{!! Form::hidden('id_instituicao', $id_instituicao, ['class' => 'form-control', 'id' => 'id_instituicao']) !!}
</div>
@endif

@section('script-end')
    @parent

    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>

    <script type="text/javascript">
        //Habilitando o campo de órgão para o envio do formulário
        $(document).on('click','#btnFormSalvarAJAX_prisma', function() {
            $("#id_orgao").prop("disabled", false);
        });
        
        $('.input-mask-cpf').mask('999.999.999-99');

    </script>
@endsection

