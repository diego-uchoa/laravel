<div class="profile-feed row">
    @foreach ($parlamentar->filiacoes as $filiacaoPartidaria)
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Partido</div>
                <div class="profile-info-value">
                    <span class="editable" id="username">{{ $filiacaoPartidaria->sg_partido.' - '.$filiacaoPartidaria->no_partido }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Período</div>
                <div class="profile-info-value">
                    <span class="editable" id="username">{{ $filiacaoPartidaria->dt_filiacao_inicio.' - '.$filiacaoPartidaria->dt_filiacao_fim }}</span>
                </div>
            </div>
        </div>
        <div class="space-4"></div>
    @endForeach
</div>