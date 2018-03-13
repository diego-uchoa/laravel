@extends('parla::layouts.master')

@section('breadcrumbs-page')

{!! Breadcrumbs::render('parla::parlamentares.show', $parlamentar) !!}

@endsection

@section('content')
        
    @section('page-header')
      Perfil do Parlamentar 
      <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            {{ $parlamentar->no_parlamentar }}
      </small>
    @endsection

    <div class="row">
        <div class="col-xs-12">        
                <div id="parlamentar-profile" class="user-profile">
                    <div class="tabbable">
                        <ul class="nav nav-tabs padding-18">
                            <li class="active">
                                <a data-toggle="tab" href="#dados_parlamentar">
                                    <i class="green ace-icon fa fa-user bigger-120"></i>
                                    Dados do Parlamentar
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#filiacoes_partidarias">
                                    <i class="orange ace-icon fa fa-suitcase bigger-120"></i>
                                    Filiações Partidárias
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#autorias">
                                    <i class="blue ace-icon fa fa-file-text bigger-120"></i>
                                    Autorias (Parla)
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#comissoes">
                                    <i class="pink ace-icon fa fa-gavel bigger-120"></i>
                                    Comissões
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content no-border padding-24">
                            <div id="dados_parlamentar" class="tab-pane in active">
                                @include('parla::parlamentares.show._dados_parlamentar')
                            </div>

                            <div id="filiacoes_partidarias" class="tab-pane">
                                @include('parla::parlamentares.show._filiacoes_partidarias')
                            </div>

                            <div id="autorias" class="tab-pane">
                                @include('parla::parlamentares.show._autorias')
                            </div>

                            <div id="comissoes" class="tab-pane">
                                @include('parla::parlamentares.show._comissoes')
                            </div>
                        </div>
                    </div>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row center">
        @if(URL::previous() === URL::route('parla::parlamentares.index'))
            <a href="{{ route('parla::parlamentares.index') }}" class="center btn btn-sm btn-danger">
                <i class="ace-icon fa fa-users bigger-110"></i>
                <span class="bigger-110">Voltar para lista de Parlamentares</span>
            </a>
        @else
            <a href="{{ URL::previous() }}" class="center btn btn-sm btn-danger">
                <i class="ace-icon fa fa-reply bigger-110"></i>
                <span class="bigger-110">Voltar</span>
            </a>
        @endif
    </div>

    <div class="formulario-container">
      @include('parla::parlamentares.posicionamento._modal')
    </div> 
      
@endsection


@section('script-end')
    <script src="{{ asset('modules/parla/js/ajax_show.js') }}"></script>
@endsection