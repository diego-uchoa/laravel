<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;

class Operacao extends AuditModel
{
    use EntrustPermissionTrait;

    protected $table = 'spoa_portal.operacao';
    protected $primaryKey = 'id_operacao';

    protected $fillable= [
        'no_operacao',
        'ds_operacao',        
        'id_sistema',
        'sn_favorita'
    ];

    public function getNameAttribute()
    {
        return $this->attributes['no_operacao'];
    }

    /*
    * Adaptação para utilizar o pacote Zizaco/Entruts
    */

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'spoa_portal.perfil_operacao','perfil_id_perfil','operacao_id_operacao');
    }

    /*
    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_operacao','id_perfil','id_operacao');
    }
    */

    public function itensMenu()
    {
       return $this->hasMany(ItemMenu::class,'id_item_menu','id_item_menu');
    }


    public function operacoesFavoritas()
    {
       return $this->belongsToMany(OperacaoFavorita::class,'id_operacao','id_operacao');
    }

    public function sistema()
    {
        return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

}
