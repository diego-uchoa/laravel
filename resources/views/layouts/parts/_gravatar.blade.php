@if (!Auth::guest())

@if(!empty($user->dadosPessoais->ds_foto))
<img class="img-circle" width="40" height="40" src="{{ URL::asset('uploads/Sisadm/avatar/'.$user->dadosPessoais->ds_foto) }}" alt="{{ $user->no_usuario }}" />
@else
<img class="img-circle" width="40" height="40" src="{{ URL::asset('assets/avatars/default.png') }}" alt="{{ $user->no_usuario }}"/>
@endif

@endif