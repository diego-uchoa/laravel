<div class="profile-feed row">
    @foreach ($parlamentar->autorias as $autoria)
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name">Origem</div>
            <div class="profile-info-value">
                <span class="editable" id="username"><a href="{{route('parla::proposicoes.show',['id'=>$autoria->proposicao->id_proposicao])}}">{{ $autoria->proposicao->sg_casa_origem.' - '.$autoria->proposicao->sg_sigla_origem.' '.$autoria->proposicao->nr_numero_origem.'/'.$autoria->proposicao->an_ano_origem }}</a></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name">Revisora</div>
            <div class="profile-info-value">
                <span class="editable" id="username">{{ $autoria->proposicao->sn_possui_revisora ? $autoria->proposicao->sg_casa_revisora.' - '.$autoria->proposicao->sg_sigla_revisora.' '.$autoria->proposicao->nr_numero_revisora.'/'.$autoria->proposicao->an_ano_revisora : '' }}</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name">Ementa</div>
            <div class="profile-info-value">
                <span class="editable" id="username">{{ $autoria->proposicao->tx_ementa }}</span>
            </div>
        </div>
    </div>
    <div class="space-4"></div>
    @endForeach
</div>