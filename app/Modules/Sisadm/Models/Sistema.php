<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;

class Sistema extends AuditModel
{

    protected $table = 'spoa_portal.sistema';
    protected $primaryKey = 'id_sistema';

    protected $fillable= [
        'id_area',
        'no_sistema',
        'ds_sistema',
        'tx_beneficio',
        'tx_publico',
        'co_esquema',
        'no_responsavel',
        'tx_email_responsavel',
        'sn_tela_inicial',
        'sn_ativo'
    ];

    public function perfis()
    {
        return $this->hasMany(Perfil::class,'id_sistema','id_sistema');
    }

    public function area()
    {
        return $this->hasOne(Area::class,'id_area', 'id_area');
    }

    public function operacoesFavoritas()
    {
        return $this->hasMany(OperacaoFavorita::class,'id_sistema','id_sistema');
    }

}
