<div id="comissoes_parlamentar" class="profile-feed row">
    @foreach ($parlamentar->comissoes->sortBy('sg_comissao') as $comissao)
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name">Comissão</div>
                <div class="profile-info-value">
                    <span class="editable" id="username"><a href="{{route('parla::comissoes.show',['id'=>$comissao->id_comissao])}}">{{ $comissao->sg_comissao.' - '.$comissao->no_comissao }}</a></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Cargo</div>
                <div class="profile-info-value">
                    <span class="editable" id="username">{{ $comissao->cargo_comissao }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Posicionamento</div>
                <div class="profile-info-value">
                    <span class="editable" id="username">
                        @if($comissao->sg_posicionamento_comissao == 'O')
                            <span class="label label-danger">
                        @elseif($comissao->sg_posicionamento_comissao == 'B')
                            <span class="label label-success">
                        @elseif($comissao->sg_posicionamento_comissao == 'I')
                            <span class="label label-default">
                        @endif
                        {{ $comissao->posicionamento_comissao }}</span>
                        @permission('parla::comissoes.show.edit')
                            <a href="#" data-url="{{route('parla::comissoes.edit.posicionamento',['id_comissao'=>$comissao->id_comissao,'id_parlamentar'=>$parlamentar->id_parlamentar,'origin'=>'perfil_parlamentar'])}}" class="update_parla" data-rel="tooltip" data-original-title="Editar posicionamento na comissão"><i class="blue fa fa-pencil bigger-120"></i></a>
                        @endpermission
                    </span>
                </div>
            </div>
        </div>
        <div class="space-4"></div>
    @endForeach
</div>