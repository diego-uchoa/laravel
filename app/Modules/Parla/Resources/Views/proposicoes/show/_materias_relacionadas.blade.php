<div class="profile-feed row">
    @foreach ($proposicao->materias_relacionadas as $materiaRelacionada)
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Casa</div>
                <div class="profile-info-value">
                    <span >{{ $materiaRelacionada->sg_casa_materia }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Matéria Relacionada</div>
                <div class="profile-info-value">
                    <span ><a href="{{ $materiaRelacionada->tx_link_materia }}" target='_blank'>{{ $materiaRelacionada->no_nome_materia }}</a></span>
                </div>
            </div>
        </div>
        <div class="space-4"></div>
    @endForeach
</div>