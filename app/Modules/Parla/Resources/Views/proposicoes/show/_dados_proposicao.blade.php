<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="widget-box widget-color-blue">
            <div class="widget-header">
                <h5 class="widget-title">Origem - <strong>{{ $proposicao->origem }}</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info casa-row">
                        <div class="profile-info-name">Casa</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->sg_casa_origem }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info codigo-row">
                        <div class="profile-info-name">Código</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->co_codigo_origem }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info terminativo-row">
                        <div class="profile-info-name">Terminativo</div>
                        <div class="profile-info-value">
                            <span >{!! $proposicao->tx_terminativo_origem !!}</span>
                        </div>
                    </div>

                    <div class="profile-user-info regime-row">
                        <div class="profile-info-name">Regime de tramitação</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->in_regime_tramitacao_origem }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info situacao-row">
                        <div class="profile-info-name">Situação</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->in_situacao_origem }} - {{ $proposicao->tx_situacao_origem }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info link-row">
                        <div class="profile-info-name">Link</div>
                        <div class="profile-info-value">
                            <span ><a href="{{ $proposicao->tx_link_origem }}" target='_blank'>{{ $proposicao->tx_link_origem }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="widget-box widget-color-green">
            <div class="widget-header">
                <h5 class="widget-title">Revisora <strong>{{ $proposicao->sn_possui_revisora ? '- '.$proposicao->revisora : '' }}</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info casa-row">
                        <div class="profile-info-name">Casa</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->sg_casa_revisora }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info codigo-row">
                        <div class="profile-info-name">Código</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->co_codigo_revisora }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info terminativo-row">
                        <div class="profile-info-name">Terminativo</div>
                        <div class="profile-info-value">
                            <span >{!! $proposicao->tx_terminativo_revisora !!}</span>
                        </div>
                    </div>

                    <div class="profile-user-info regime-row">
                        <div class="profile-info-name">Regime de tramitação</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->in_regime_tramitacao_revisora }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info situacao-row">
                        <div class="profile-info-name">Situação</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->sn_possui_revisora ? $proposicao->in_situacao_revisora.' - '.$proposicao->tx_situacao_revisora : ''}}</span>
                        </div>
                    </div>

                    <div class="profile-user-info link-row">
                        <div class="profile-info-name">Link</div>
                        <div class="profile-info-value">
                            <span ><a href="{{ $proposicao->tx_link_revisora }}" target='_blank'>{{ $proposicao->tx_link_revisora }}</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12">
        <div class="widget-box widget-color-purple">
            <div class="widget-header">
                <h5 class="widget-title">Dados gerais</strong></h5>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="profile-user-info">
                        <div class="profile-info-name">Ementa</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->tx_ementa }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Palavras-chave</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->tx_palavra_chave }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Autor</div>
                        <div class="profile-info-value">
                            <span >@if($proposicao->autoria->id_parlamentar)<a href="{{ route('parla::parlamentares.show',['id'=>$proposicao->autoria->id_parlamentar]) }}">{{ $proposicao->autoria->no_nome_autor }} </a> @else {{$proposicao->autoria->no_nome_autor}} @endif</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Tipo do autor</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->autoria->in_tipo_autor }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Partido do autor</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->autoria->sg_partido_autor }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">UF do autor</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->autoria->sg_uf_autor }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Prioritário</div>
                        <div class="profile-info-value">
                            <span class="editable">{{ $proposicao->nr_prioritario }}</span>
                            @permission('parla::proposicoes.edit.prioritario')
                                <a href="#" data-url="{{route('parla::proposicoes.edit.prioritario',['id'=>$proposicao->id_proposicao])}}" class="update_parla" data-rel="tooltip" data-original-title="Editar"><i class="blue fa fa-pencil bigger-120"></i></a>
                            @endpermission
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Norma gerada</div>
                        <div class="profile-info-value">
                            <span >{{ $proposicao->tx_norma_gerada }}</span>
                        </div>
                    </div>

                    <div class="profile-user-info">
                        <div class="profile-info-name">Observações</div>
                        <div class="profile-info-value">
                            <span class="editable">{{ $proposicao->tx_observacao }}</span>
                            @permission('parla::proposicoes.edit.observacao')
                                <a href="#" data-url="{{route('parla::proposicoes.edit.observacao',['id'=>$proposicao->id_proposicao])}}" class="update_parla" data-rel="tooltip" data-original-title="Editar"><i class="blue fa fa-pencil bigger-120"></i></a>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <small><i class="fa fa-info-circle"></i> Proposição cadastrada no Parla em {{ $proposicao->created_at }}. Última atualização em {{ $proposicao->updated_at }}.</small>
</div>