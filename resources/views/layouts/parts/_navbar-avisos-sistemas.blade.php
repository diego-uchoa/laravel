<?php 
$helper = app('App\Helpers\UtilHelper'); 
\Carbon\Carbon::setLocale('pt_BR'); 
?>
@php 
$avisos = @cache('menu-avisos-sistemas-' . $helper->getSistema());
$qtdAvisos = @cache('qtd-avisos-sistemas-' . $helper->getSistema());
@endphp
<li class="transparent">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#" data-rel="tooltip" data-placement="bottom" data-original-title="Avisos do Sistema">
        <i class="ace-icon fa fa-bell"></i><span class="badge badge-danger">{{ $qtdAvisos > 0 ? $qtdAvisos : '' }}</span>
    </a>

    <div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#navbar-messages">
                        Notificações
                        <span class="badge badge-danger">{{ $qtdAvisos > 0 ? $qtdAvisos : '' }}</span>
                    </a>
                </li>
            </ul><!-- .nav-tabs -->

            <div class="tab-content">
                <div id="navbar-messages" class="tab-pane active">
                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar">
                                @if (!empty($avisos))
                                    @foreach($avisos as $aviso)
                                    <li>
                                        <a href="#">
                                            <span class="msg-body">
                                                <span class="msg-title">                                            
                                                    @if(isset ($aviso->no_sistema))
                                                       <i>{{ Html::image('icones/icone_' . $aviso->no_sistema . '.png', $aviso->no_sistema,array( 'width' => 20, 'height' => 20 )) }}</i>
                                                    @endif
                                                    <span class="blue">{{ $aviso->no_tipo_aviso_sistema }}:</span>
                                                    {{ $aviso->tx_aviso_sistema }}
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
                                    <a href="{{route('sisadm::aviso_geral.index',['sistema'=> $helper->getSistema()])}}" target="_blank">
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

