
<div class="col-lg-12">
    
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('cpf', 'CPF:') !!}
                {!! Form::text('nr_cpf', null, ['class'=>'form-control input-large input-mask-cpf', 'id'=>'nr_cpf']) !!}
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                {!! Form::label('nome', 'Nome:') !!}
                {!! Form::text('no_servidor', null, ['class'=>'form-control input-xxlarge', 'id'=>'no_servidor']) !!}
            </div>
        </div>
    </div>
    <div id="collapse-form" class="collapse">
    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('rg', 'RG:') !!}
                {!! Form::text('nr_rg', null, ['class'=>'form-control', 'id'=>'nr_rg']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('dt_nascimento', 'Data de Nascimento:') !!}
                {!! Form::text('dt_nascimento', null, ['class'=>'form-control input-data', 'id'=>'dt_nascimento']) !!}
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                {!! Form::label('sexo', 'Sexo:') !!}
                @if(isset($servidor))
                    <select name="in_sexo" id='in_sexo' class="form-control" required>
                        <option value="F" @if($servidor->in_sexo == 'F') selected @endif >F</option>
                        <option value="M" @if($servidor->in_sexo == 'M') selected @endif>M</option>
                    </select>
                @else
                    <select name="in_sexo" id='in_sexo' class="form-control" required>
                        <option value="F">F</option>
                        <option value="M">M</option>
                    </select>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('ds_email', null, ['class'=>'form-control input-xxlarge', 'id'=>'ds_email']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('telefone', 'Telefone Unidade:') !!}
                {!! Form::text('tx_telefone_unidade', null, ['class'=>'form-control input-large telefone-com-ddd', 'id'=>'tx_telefone_unidade']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('telefone', 'Telefone Celular:') !!}
                {!! Form::text('tx_telefone_celular', null, ['class'=>'form-control input-large telefone-com-ddd', 'id'=>'tx_telefone_celular']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('telefone', 'Telefone Residencial:') !!}
                {!! Form::text('tx_telefone_residencial', null, ['class'=>'form-control input-large telefone-com-ddd', 'id'=>'tx_telefone_residencial']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <hr>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('siape', 'Matrícula SIAPE:') !!}
                {!! Form::text('nr_siape', null, ['class'=>'form-control', 'id'=>'nr_siape']) !!}
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                {!! Form::label('cargo', 'Cargo:') !!}
                {!! Form::text('no_cargo', null, ['class'=>'form-control', 'id'=>'no_cargo']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('regime', 'Regime Jurídico:') !!}
                {!! Form::select('in_regime_juridico',$regimeJuridico, null, ['class'=>'form-control' , 'id'=>'in_regime_juridico']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('situacaoServidor', 'Situação Servidor:') !!}
                {!! Form::select('in_situacao_servidor',$situacaoServidor, null, ['class'=>'form-control' , 'id'=>'in_situacao_servidor']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('tx_local_arquivo_geral', 'Local Arquivo Geral:') !!}
                {!! Form::text('tx_local_arquivo_geral', null, ['class'=>'form-control input-large', 'id'=>'tx_local_arquivo_geral']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('orgao', 'Órgão:') !!}
                {!! Form::text('no_orgao', null, ['class'=>'form-control', 'id'=>'no_orgao']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('no_unidade_lotacao', 'Unidade de Lotação:') !!}
                {!! Form::text('no_unidade_lotacao', null, ['class'=>'form-control input-large', 'id'=>'no_unidade_lotacao']) !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {!! Form::label('no_unidade_exercicio', 'Unidade de Exercício:') !!}
                {!! Form::text('no_unidade_exercicio', null, ['class'=>'form-control input-large', 'id'=>'no_unidade_exercicio']) !!}
            </div>
        </div>
    </div>
    <div class="row" id="div-btn-form">
        <hr>
        {!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!} 
        <a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>       
    </div>
    </div>
</div>


@section('script-end')
  @parent
	<script src="{{ URL::asset('assets/js/chosen.jquery.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    
	<script type="text/javascript">

	    $('.input-mask-cpf').mask('999.999.999-99');

        $('.telefone-com-ddd').mask('(99) 9999-9999');

        $('.input-data').mask('99/99/9999');

	</script>
@endsection