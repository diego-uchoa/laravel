@extends('sisadm::layouts.master-modal')

@section('content')

@section('page-header')
<i class="ace-icon fa fa-question-circle orange"></i> Avisos
@endsection

<?php \Carbon\Carbon::setLocale('pt_BR'); ?>

<div class="row">

  <div class="col-sm-3">

    <div class="widget-box transparent">
      <div class="widget-header widget-header-small">
        <h4 class="widget-title blue smaller">
          <i class="ace-icon fa fa-rss orange"></i>
          Avisos Gerais para o Usuário
        </h4>                 
      </div>

      <div class="widget-body">
        <div class="widget-main padding-8">
          <div id="profile-feed-1" class="profile-feed">

          @foreach($avisosUsuarioGeral as $avisoUsuarioGeral)

            <div class="profile-activity clearfix">
              <div>
                <span class="blue">{{ $avisoUsuarioGeral->no_tipo_aviso_usuario }}:</span>
                <span>
                {{ $avisoUsuarioGeral->tx_aviso_usuario }}
                </span>
                <div class="time">
                  <div><i class="ace-icon fa fa-clock-o bigger-110"></i>Criado em: 
                  {{ Carbon\Carbon::parse($avisoUsuarioGeral->created_at)->diffForHumans() }}
                  </div>
                  <div>Lido em: 
                  {{ Carbon\Carbon::parse($avisoUsuarioGeral->dt_lido)->diffForHumans() }}
                  </div>
                </div>
              </div>                       
            </div>

          @endforeach

          </div>
        </div>
      </div>
    </div>
    
  </div><!-- Avisos Gerais para o Usuário-->
  
  <div class="col-sm-3">

    <div class="widget-box transparent">
      <div class="widget-header widget-header-small">
        <h4 class="widget-title blue smaller">
          <i class="ace-icon fa fa-rss orange"></i>
          Avisos para o Usuário do Sistema
        </h4>                 
      </div>

      <div class="widget-body">
        <div class="widget-main padding-8">
          <div id="profile-feed-1" class="profile-feed">

          @foreach($avisosUsuario as $avisoUsuario)

            <div class="profile-activity clearfix">
              <div>
                <i>{{ Html::image('icones/icone_' . $avisoUsuario->no_sistema . '.png', $avisoUsuario->no_sistema , array( 'width' => 20, 'height' => 20 )) }}</i>
                <span class="blue">{{ $avisoUsuario->no_tipo_aviso_usuario }}:</span>
                <span>
                {{ $avisoUsuario->tx_aviso_usuario }}
                </span>
                <div class="time">
                  <div><i class="ace-icon fa fa-clock-o bigger-110"></i>Criado em: 
                  {{ Carbon\Carbon::parse($avisoUsuario->created_at)->diffForHumans() }}
                  </div>
                  <div>Lido em:
                   {{ Carbon\Carbon::parse($avisoUsuario->dt_lido)->diffForHumans() }}
                  </div>
                </div>
              </div>                       
            </div>

          @endforeach

          </div>
        </div>
      </div>
    </div>
    
  </div><!-- Avisos Gerais do Usuário para o Sistema -->

  <div class="col-sm-3">

    <div class="widget-box transparent">
      <div class="widget-header widget-header-small">
        <h4 class="widget-title blue smaller">
          <i class="ace-icon fa fa-rss orange"></i>
          Avisos Gerais de Sistema
        </h4>
      </div>

      <div class="widget-body">
        <div class="widget-main padding-8">
          <div id="profile-feed-1" class="profile-feed">

          @foreach($avisosSistemaGeral as $avisoSistemaGeral)

            <div class="profile-activity clearfix">
              <div>
                <span class="blue">{{ $avisoSistemaGeral->no_tipo_aviso_sistema }}:</span>
                <span>
                {{ $avisoSistemaGeral->tx_aviso_sistema }}
                </span>
                <div class="time">
                  <i class="ace-icon fa fa-clock-o bigger-110"></i>
                  <span>Criado em:
                   {{ Carbon\Carbon::parse($avisoSistemaGeral->created_at)->diffForHumans() }}
                   </span>
                </div>
              </div>                        
            </div>     

            @endforeach                               

          </div>
        </div>
      </div>
    </div>

  </div> <!-- Avisos Gerais do Sistema -->

  <div class="col-sm-3">


    <div class="widget-box transparent">
      <div class="widget-header widget-header-small">
        <h4 class="widget-title blue smaller">
          <i class="ace-icon fa fa-rss orange"></i>
          Avisos do Sistema
        </h4>
      </div>

      <div class="widget-body">
        <div class="widget-main padding-8">
          <div id="profile-feed-1" class="profile-feed">

          @foreach($avisosSistema as $avisoSistema)

            <div class="profile-activity clearfix">
              <div>
                <i>{{ Html::image('icones/icone_' . $avisoSistema->no_sistema . '.png', $avisoSistema->no_sistema , array( 'width' => 20, 'height' => 20 )) }}</i>
                <span class="blue">{{ $avisoSistema->no_tipo_aviso_sistema }}:</span>
                <span>
                {{ $avisoSistema->tx_aviso_sistema }}
                </span>
                <div class="time">
                  <i class="ace-icon fa fa-clock-o bigger-110"></i>
                  <span>Criado em: 
                  {{ Carbon\Carbon::parse($avisoSistema->created_at)->diffForHumans() }}
                  </span>
                </div>
              </div>                        
            </div>     

            @endforeach                               

          </div>
        </div>
      </div>
    </div>  
  </div> <!-- Avisos do Sistema -->

</div><!-- /.row -->          

@endsection
