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
        
    <div class="row">
        <div class="col-xs-12 col-sm-4">
                <div class="widget-box widget-color-navy">
                    <div class="widget-header">
                        <h5 class="widget-title"><i class="ace-icon fa fa-university"></i> Instituição</h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            
                            <div class="alert alert-sucess">

                                <i class="ace-icon fa fa-check bigger-110 green"></i>
                                <strong>Instituição</strong> cadastrada com sucesso.
                                <br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-8">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box widget-color-navy">
                            <div class="widget-header">
                                <h5 class="widget-title"><i class="ace-icon fa fa-user"></i> Responsável <strong></strong></h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    
                                        <div class="widget-body">
                                            <div class="widget-main padding-8">

                                                <div class="profile-activity clearfix">
                                                    <div>
                                                        <span class="gray middle bolder">{{ $result['resultCadastroResponsavel'][0]['nr_cpf'] }}</span> - {{$result['resultCadastroResponsavel'][0]['no_usuario']}}

                                                        <div class="time">
                                                            @if($result['resultCadastroResponsavel'][0]['result']->getOriginalContent()['status'] == 'error')
                                                            <i class="ace-icon fa fa-times bigger-110 red"></i>
                                                            @else
                                                            <i class="ace-icon fa fa-check bigger-110 green"></i>
                                                            @endif

                                                            {{ $result['resultCadastroResponsavel'][0]['result']->getOriginalContent()['msg'] }}
                                                            &nbsp;&nbsp;&nbsp;

                                                            @if($result['resultCadastroResponsavel'][0]['result_associacao']->getOriginalContent()['status'] == 'error')
                                                            <i class="ace-icon fa fa-times bigger-110 red"></i>
                                                            @else
                                                            <i class="ace-icon fa fa-check bigger-110 green"></i>
                                                            @endif

                                                            {{ $result['resultCadastroResponsavel'][0]['result_associacao']->getOriginalContent()['msg'] }}
                                                            &nbsp;&nbsp;&nbsp;


                                                            @if($result['resultCadastroResponsavel'][0]['result_perfil']->getOriginalContent()['status'] == 'error')
                                                            <i class="ace-icon fa fa-times bigger-110 red"></i>
                                                            @else
                                                            <i class="ace-icon fa fa-check bigger-110 green"></i>
                                                            @endif

                                                            {{ $result['resultCadastroResponsavel'][0]['result_perfil']->getOriginalContent()['msg'] }}
                                                            &nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-6"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="widget-box widget-color-navy">
                            <div class="widget-header">
                                <h5 class="widget-title"><i class="ace-icon fa fa-users"></i> Editores</h5>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    

                                    @foreach($result['resultCadastroEditores'] as $editor)
                                    
                                        <div class="widget-body">
                                            <div class="widget-main padding-8">

                                                <div class="profile-activity clearfix">
                                                    <div>
                                                        <span class="gray middle bolder">{{ $editor['nr_cpf'] }}</span> - {{$editor['no_usuario']}}
                                                        
                                                        <div class="time">
                                                            @if($editor['result']->getOriginalContent()['status'] == 'error')
                                                                <i class="ace-icon fa fa-times bigger-110 red"></i>
                                                            @else
                                                                <i class="ace-icon fa fa-check bigger-110 green"></i>
                                                            @endif
                                                            
                                                            {{ $editor['result']->getOriginalContent()['msg'] }}
                                                            &nbsp;&nbsp;&nbsp;
    

                                                            @if($editor['result_associacao']->getOriginalContent()['status'] == 'error')
                                                                <i class="ace-icon fa fa-times bigger-110 red"></i>
                                                            @else
                                                                <i class="ace-icon fa fa-check bigger-110 green"></i>
                                                            @endif
                                                            
                                                            {{ $editor['result_associacao']->getOriginalContent()['msg'] }}
                                                            &nbsp;&nbsp;&nbsp;

                                                            @if($editor['result_perfil']->getOriginalContent()['status'] == 'error')
                                                                <i class="ace-icon fa fa-times bigger-110 red"></i>
                                                            @else
                                                                <i class="ace-icon fa fa-check bigger-110 green"></i>
                                                            @endif
                                                            
                                                            {{ $editor['result_perfil']->getOriginalContent()['msg'] }}
                                                            &nbsp;&nbsp;&nbsp;
                                                        </div>
                                                    
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>

    </div>
    <div class="hr hr-18 dotted hr-double"></div>

    

@endsection