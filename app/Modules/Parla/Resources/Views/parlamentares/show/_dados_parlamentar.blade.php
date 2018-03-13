<div class="row" id="show_dados_parlamentar">
    <div class="col-xs-12 col-sm-3 center">
        <span class="profile-picture">
            <img class="editable img-responsive" id="foto" 
            src="{{ $parlamentar->aq_foto ? URL::asset($parlamentar->aq_foto) : URL::asset('assets/avatars/default.png') }}"/>
        </span>
    </div>

    <div class="col-xs-12 col-sm-9">
        <h4 class="blue">
            <span class="middle">{{ $parlamentar->no_parlamentar }}</span>
        </h4>

        <div class="profile-user-info">
            <div class="profile-info-name">Código</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->co_parlamentar }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">Nome Civil</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->no_civil }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">Sexo</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->in_sexo }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">Cargo</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->in_cargo }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">Nascimento</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->dt_nascimento }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">UF</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->sg_uf_parlamentar }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">E-mail</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->ds_email }}</span>
            </div>
        </div>

        <div class="profile-user-info">
            <div class="profile-info-name">Em exercício</div>
            <div class="profile-info-value">
                <span>{{ $parlamentar->sn_exercicio }}</span>
            </div>
        </div>
        <div class="profile-user-info">
            <div class="profile-info-name">Posicionamento</div>
            <div class="profile-info-value">
                @if($parlamentar->in_posicionamento == 'O')
                <span class="label label-danger">{{ $parlamentar->no_posicionamento }}</span>
                @elseif($parlamentar->in_posicionamento == 'B')
                <span class="label label-success">{{ $parlamentar->no_posicionamento }}</span>
                @elseif($parlamentar->in_posicionamento == 'I')
                <span class="label label-default">{{ $parlamentar->no_posicionamento }}</span>
                @endif
                @permission('parla::parlamentares.edit')
                <a href="#" data-url="{{route('parla::parlamentares.edit.posicionamento',['id'=>$parlamentar->id_parlamentar])}}" class="update_parla" data-rel="tooltip" data-original-title="Editar posicionamento"><i class="blue fa fa-pencil bigger-120"></i></a>
                @endpermission
            </div>
        </div>
    </div>
</div>