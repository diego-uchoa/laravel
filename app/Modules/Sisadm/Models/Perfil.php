<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Perfil extends AuditModel
{
    use EntrustRoleTrait;

    protected $fillable= [
        'no_perfil',
        'ds_perfil',
        'id_sistema'
    ];

    protected $table = 'spoa_portal.perfil';
    protected $primaryKey = 'id_perfil';

    public function getNameAttribute()
    {
        return $this->attributes['no_perfil'];
    }

    public function operacoes()
    {
        return $this->belongsToMany(Operacao::class,'spoa_portal.perfil_operacao','perfil_id_perfil','operacao_id_operacao');
    }

    public function sistema()
    {
        return $this->hasOne(Sistema::class,'id_sistema','id_sistema');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class,'spoa_portal.usuario_perfil','id_perfil','id_usuario');
    }

    public function addOperacoes(Operacao $operacao)
    {
        return $this->operacoes()->save($operacao);
    }

    public function revokeOperacoes(Operacao $operacao)
    {
        return $this->operacoes()->detach($operacao);
    }

}
