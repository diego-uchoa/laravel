<div class="profile-feed row">
    @foreach ($proposicao->apensados as $apensado)
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Casa</div>
                <div class="profile-info-value">
                    <span >{{ $apensado->sg_casa_apensado }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Apensado</div>
                <div class="profile-info-value">
                    <span ><a href="{{ $apensado->tx_link_apensado }}" target='_blank'>{{ $apensado->no_nome_apensado }}</a></span>
                </div>
            </div>
        </div>
        <div class="space-4"></div>
    @endForeach
</div>