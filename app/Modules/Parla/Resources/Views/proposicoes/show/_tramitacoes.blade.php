<div class="profile-feed row">
    @foreach ($proposicao->tramitacoes as $tramitacao)
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Data</div>
                <div class="profile-info-value">
                    <span >{{ $tramitacao->dt_data_tramitacao }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Casa</div>
                <div class="profile-info-value">
                    <span >{{ $tramitacao->sg_casa_tramitacao }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Órgão</div>
                <div class="profile-info-value">
                    <span >{{ $tramitacao->no_orgao_tramitacao }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Andamento</div>
                <div class="profile-info-value">
                    <span >{{ $tramitacao->tx_andamento }}</span>
                </div>
            </div>
        </div>
        <div class="space-4"></div>
    @endForeach
</div>