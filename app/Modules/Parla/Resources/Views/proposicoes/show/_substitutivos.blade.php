<div class="profile-feed row">
    @foreach ($proposicao->substitutivos as $substitutivo)
        <div class="profile-user-info profile-user-info-striped">

            <div class="profile-info-row">
                <div class="profile-info-name">Casa</div>
                <div class="profile-info-value">
                    <span >{{ $substitutivo->sg_casa_substitutivo }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Substitutivo</div>
                <div class="profile-info-value">
                    <span ><a href="{{ $substitutivo->tx_link_substitutivo }}">{{ $substitutivo->no_nome_substitutivo }}</a></span>
                </div>
            </div>

        </div>
        <div class="space-4"></div>
    @endForeach
</div>