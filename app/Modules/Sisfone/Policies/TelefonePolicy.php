<?php

namespace App\Modules\Sisfone\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Modules\Sisadm\Models\User;
use App\Modules\Sisfone\Models\Telefone;

class TelefonePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $usuario, Telefone $telefone)
    {
        return $usuario->id_usuario === $telefone->id_usuario;
    }

    public function delete(User $usuario,  Telefone $telefone)
    {
      return $usuario->id_usuario === $telefone->id_usuario;
    }
}
