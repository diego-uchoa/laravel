<div class="row">
     <div class="col-sm-2">
        <!-- Nr Cnpj Field -->
        <div class="form-group">
            {!! Form::label('nr_cnpj', 'CNPJ:') !!}
            {!! Form::text('nr_cnpj', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
     </div>
     <div class="col-sm-4">
         <!-- No Razao Social Field -->
         <div class="form-group">
             {!! Form::label('no_razao_social', 'Razão Social:') !!}
             {!! Form::text('no_razao_social', null, ['class' => 'form-control', 'readonly']) !!}
         </div>
     </div>
     <div class="col-sm-4">
         <!-- No Fantasia Field -->
         <div class="form-group">
             {!! Form::label('no_relatorio', 'Nome da Instituição para Relatórios:') !!}
             {!! Form::text('no_relatorio', null, ['class' => 'form-control']) !!}
         </div>
     </div>
     <div class="col-sm-2">
         <!-- No Situacao Field -->
         <div class="form-group">
             {!! Form::label('no_situacao', 'Situação Cadastral:') !!}
             {!! Form::text('no_situacao', null, ['class' => 'form-control', 'readonly']) !!}
         </div>
     </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <!-- Nr Telefone Field -->
        <div class="form-group">
            {!! Form::label('nr_telefone', 'Telefone:') !!}
            {!! Form::text('nr_telefone', null, ['class' => 'form-control input-mask-telefone-ddd', 'readonly']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <!-- Ds Email Field -->
        <div class="form-group">
            {!! Form::label('ds_email', 'E-mail:') !!}
            {!! Form::text('ds_email', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
</div>
 
<div class="row">
    <div class="col-sm-2">
        <!-- Ed Cep Logradouro Field -->
        <div class="form-group">
            {!! Form::label('ed_cep_logradouro', 'CEP:') !!}
            {!! Form::text('ed_cep_logradouro', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-sm-8">
        <!-- Ed Logradouro Field -->
        <div class="form-group">
            {!! Form::label('ed_logradouro', 'Logradouro:') !!}
            {!! Form::text('ed_logradouro', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <!-- Ed Numero Logradouro Field -->
        <div class="form-group">
            {!! Form::label('ed_numero_logradouro', 'Número:') !!}
            {!! Form::number('ed_numero_logradouro', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <!-- Ed Complemento Logradouro Field -->
        <div class="form-group">
            {!! Form::label('ed_complemento_logradouro', 'Complemento:') !!}
            {!! Form::text('ed_complemento_logradouro', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <!-- Ed Bairro Logradouro Field -->
        <div class="form-group">
            {!! Form::label('ed_bairro_logradouro', 'Bairro:') !!}
            {!! Form::text('ed_bairro_logradouro', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <!-- Ed Municipio Logradouro Field -->
        <div class="form-group">
            {!! Form::label('ed_municipio_logradouro', 'Município:') !!}
            {!! Form::text('ed_municipio_logradouro', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
    <div class="col-sm-2">
        <!-- Ed Sigla Uf Field -->
        <div class="form-group">
            {!! Form::label('ed_sigla_uf', 'UF:') !!}
            {!! Form::text('ed_sigla_uf', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-2">
        <!-- Nr Cpf Responsavel Field -->
        <div class="form-group">
            {!! Form::label('nr_cpf_responsavel', 'CPF Responsável:') !!}
            {!! Form::text('nr_cpf_responsavel', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <!-- No Responsavel Field -->
        <div class="form-group">
            {!! Form::label('no_responsavel', 'Responsável:') !!}
            {!! Form::text('no_responsavel', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <!-- No Cargo Responsavel Field -->
        <div class="form-group">
            {!! Form::label('no_cargo_responsavel', 'Cargo Responsável:') !!}
            {!! Form::text('no_cargo_responsavel', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <!-- Ds Email Responsavel Field -->
        <div class="form-group">
            {!! Form::label('ds_email_responsavel', 'E-mail Responsável:') !!}
            {!! Form::text('ds_email_responsavel', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <!-- Nr Telefone Responsavel Field -->
        <div class="form-group">
            {!! Form::label('nr_telefone_responsavel', 'Telefone Responsável:') !!}
            {!! Form::text('nr_telefone_responsavel', null, ['class' => 'form-control input-mask-telefone-ddd']) !!}
        </div>
    </div>
    
</div>


<!-- Submit Field -->
{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>

@section('script-end')

    @parent

    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.maskTelefone.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.mascaraTelefone();
        });
    </script>

@endsection