<div class="profile-feed row">
    @foreach ($proposicao->emendas as $emenda)
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Casa</div>
                <div class="profile-info-value">
                    <span >{{ $emenda->sg_casa_emenda }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Emenda</div>
                <div class="profile-info-value">
                    <span ><a href="{{ $emenda->tx_link_emenda }}">{{ $emenda->no_nome_emenda }}</a></span>
                </div>
            </div>

        </div>
        <div class="space-4"></div>
    @endForeach
</div>