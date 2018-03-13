<?php 

$helper = app('App\Helpers\UtilHelper'); 
\Carbon\Carbon::setLocale('pt_BR'); 

?>
@php 
$avisos = @cache('menu-avisos-usuarios-geral-'. $helper->getUsername());
$qtdAvisos = @cache('qtd-avisos-usuarios-geral-'. $helper->getUsername());
@endphp
<li class="transparent">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#" data-rel="tooltip" data-placement="bottom" data-original-title="Avisos para o Usuário">
        <i class="ace-icon fa fa-envelope"></i><span class="badge badge-danger">{{ $qtdAvisos > 0 ? $qtdAvisos : '' }}</span>
    </a>

    <div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#navbar-messages">
                        Mensagens
                        <span class="badge badge-danger">{{ $qtdAvisos > 0 ? $qtdAvisos : '' }}</span>
                    </a>
                </li>
            </ul><!-- .nav-tabs -->

            <div class="tab-content">
                <div id="navbar-messages" class="tab-pane active">
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                @if($avisos)
                                    @foreach($avisos as $aviso)
                                    <li>
                                        <a href="#">
                                            <span class="msg-body">
                                                <span class="msg-title">
                                                    @if(isset ($aviso->no_sistema))
                                                       <i>{{ Html::image('icones/icone_' . $aviso->no_sistema . '.png', $aviso->no_sistema,array( 'width' => 20, 'height' => 20 )) }}</i>
                                                    @endif                                        
                                                    <span class="blue">{{ $aviso->no_tipo_aviso_usuario }}:</span>
                                                    {{ $aviso->tx_aviso_usuario }}
                                                </span>

                                                <span class="msg-time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span>{{ Carbon\Carbon::parse($aviso->created_at)->diffForHumans() }}</span>
                                                </span>
                                            </span>
                                        </a>                                  
                                    </li>
                                    @endforeach
                                @endif
                                <li class="dropdown-footer">
                                    <a href="{{route('sisadm::aviso_geral.indexGeral')}}">
                                        Ver todas
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div><!-- /.tabbable -->
            </div><!-- /.dropdown-menu -->
        </li>

