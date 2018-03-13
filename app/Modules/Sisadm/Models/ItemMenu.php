<?php

namespace App\Modules\Sisadm\Models;

use App\Models\AuditModel;

class ItemMenu extends AuditModel
{
    
    protected $table = 'spoa_portal.item_menu';
    protected $primaryKey = 'id_item_menu';

    protected $fillable= [
        'no_item_menu',
        'rota',
        'ordem',
        'icon',
        'tipo',
        'id_sistema',
        'id_operacao',        
        'id_item_menu_precedente'
    ];

    public function itemMenuPrecedente()
    {
        return $this->hasOne(ItemMenu::class,'id_item_menu','id_item_menu_precedente');
    }

    public function itensMenuFilhos()
    {
        return $this->hasMany(ItemMenu::class,'id_item_menu_precedente','id_item_menu');
    }

    public function sistema()
    {
        return $this->hasOne(Sistema::class,'id_sistema','id_sistema');
    } 

    public function operacao()
    {
        return $this->hasOne(Operacao::class,'id_operacao','id_operacao');
    }   

}
