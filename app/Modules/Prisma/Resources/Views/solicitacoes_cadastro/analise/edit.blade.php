@extends('prisma::layouts.master')

@section('breadcrumbs-page')
  
  {!! Breadcrumbs::render('prisma::solicitacao.cadastro.edit', $solicitacaoCadastro) !!}

@endsection


@section('page-header')
  Solicitação de Cadastro 
  <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $solicitacaoCadastro->no_razao_social }}
  </small>
@endsection


@section('content')

@if($solicitacaoCadastro->in_situacao_solicitacao == 'R')
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
                <i class="ace-icon fa fa-times"></i>
                Solicitação rejeitada!
            </strong>
            A solicitação foi rejeitada em {{ $solicitacaoCadastro->dt_analise }} por {{ $solicitacaoCadastro->usuarioAnalise->no_usuario }}.
        </p>
    </div>
@elseif($solicitacaoCadastro->in_situacao_solicitacao == 'A')
    <div class="alert alert-block alert-success">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
            <i class="ace-icon fa fa-check"></i>
                Solicitação aprovada!
            </strong>
            A solicitação foi aprovada em {{ $solicitacaoCadastro->dt_analise }} por {{ $solicitacaoCadastro->usuarioAnalise->no_usuario }}.
        </p>
    </div>
@elseif($solicitacaoCadastro->in_situacao_solicitacao == 'E')
    <div class="alert alert-block alert-warning">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
            <i class="ace-icon fa fa-info-circle"></i>
                Solicitação em análise!
            </strong>
            A solicitação está sendo analisada, com última alteração em {{ $solicitacaoCadastro->updated_at }}.
        </p>
    </div>
@elseif($solicitacaoCadastro->in_situacao_solicitacao == 'P')
    <div class="alert alert-block alert-warning">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <p>
            <strong>
            <i class="ace-icon fa fa-info-circle"></i>
                Solicitação aguardando análise!
            </strong>
        </p>
    </div>
@endif
	
@include('prisma::solicitacoes_cadastro.analise._dados_solicitacao')


@if($solicitacaoCadastro->in_situacao_solicitacao == 'P' || $solicitacaoCadastro->in_situacao_solicitacao == 'E')
    {!! Form::model($solicitacaoCadastro, ['route'=>['prisma::solicitacao.cadastro.update', $solicitacaoCadastro->id_solicitacao_cadastro], 'method'=>'put', 'class' => 'form-horizontal', 'id' => 'formulario']) !!}
        <div class="row">
            <div class="col-xs-12">
                <div class="search-area well well-sm">

                    <h5 class="navy">
                        <i class="ace-icon fa fa-link light-grey bigger-110"></i>
                        Instituição Responsável pela Previsão
                    </h5>

                    <div class="widget-main">
                        <div class="row">
                            <div class="col-xs-12 col-sm-2">
                                <div class="form-group">
                                    {!! Form::select('id_instituicao_responsavel_previsao',$instituicaoResponsavelPrevisao, null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>   

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="search-area well well-sm">

                    <h5 class="navy">
                        <i class="ace-icon fa fa-check light-grey bigger-110"></i>
                        Análise de Solicitação de Cadastro
                    </h5>

                    <div class="widget-main">
                        @include('prisma::solicitacoes_cadastro.analise._form',['submit_text' => 'Salvar'])
                    </div>   

                </div>
            </div>
        </div>
    {!! Form::close() !!} 
@elseif($solicitacaoCadastro->in_situacao_solicitacao == 'A' || $solicitacaoCadastro->in_situacao_solicitacao == 'R')
    <div class="row">
        <div class="col-xs-12">
            <div class="search-area well well-sm">

                <h5 class="navy">
                    <i class="ace-icon fa fa-link light-grey bigger-110"></i>
                    Instituição Responsável pela Previsão
                </h5>

                <div class="widget-main">
                    {{ optional($solicitacaoCadastro->instituicaoPrevisao)->no_instituicao_responsavel_previsao }}
                </div>   

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="search-area well well-sm">

                <h5 class="navy">
                    <i class="ace-icon fa fa-check light-grey bigger-110"></i>
                    Análise de Solicitação de Cadastro
                </h5>

                <div class="widget-main">
                    {{ $solicitacaoCadastro->tx_analise }}
                </div>   

            </div>
        </div>
    </div>
@endif
  
@endsection

@section('script-end')
    
    <script type="text/javascript">

      $('#bt_aprovar').click(function() {

        var rota = "{!! route('prisma::solicitacao.cadastro.aprovar'); !!}";
        $('#formulario').attr('action', rota);
        $('#formulario').submit();

      });

      $('#bt_rejeitar').click(function() {

        var rota = "{!! route('prisma::solicitacao.cadastro.rejeitar'); !!}";
        $('#formulario').attr('action', rota);
        $('#formulario').submit();

      });


    </script>



    <style>

        
        .profile-instituicao-info {
            display: table;
            width: 98%;
            width: calc(100% - 24px);
            margin: 0 auto;
        }
        .profile-instituicao-name {
            text-align: right;
            padding: 6px 10px 6px 4px;
            font-weight: 400;
            color: #667E99;
            background-color: transparent;
            border-top: 1px dotted #D5E4F1;
            display: table-cell;
            width: 180px;
            vertical-align: middle;
        }
        .profile-instituicao-responsavel-name {
            text-align: right;
            padding: 6px 10px 6px 4px;
            font-weight: 400;
            color: #667E99;
            background-color: transparent;
            border-top: 1px dotted #D5E4F1;
            display: table-cell;
            width: 110px;
            vertical-align: middle;
        }
        .profile-instituicao-value {
            display: table-cell;
            padding: 6px 4px 6px 6px;
            border-top: 1px dotted #D5E4F1;
        }
        .profile-instituicao-value>span+span:before {
            display: inline;
            content: ", ";
            margin-left: 1px;
            margin-right: 3px;
            color: #666;
            border-bottom: 1px solid #FFF;
        }
        .profile-instituicao-value>span+span.editable-container:before {
            display: none;
        }

    </style>

@endsection