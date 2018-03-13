<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class OperacaoFavorita extends BaseModel
{
    protected $table = 'spoa_portal.operacao_favorita';
    protected $primaryKey = 'id_operacao_favorita';

    protected $fillable= [
        'id_operacao',
        'id_usuario',
        'id_sistema'
    ];

    public function operacao()
    {
        return $this->belongsTo('App\Modules\Sisadm\Models\Operacao', 'id_operacao', 'id_operacao');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Modules\Sisadm\Models\User', 'id_usuario', 'id_usuario');
    }

    public function sistema()
    {
        return $this->belongsTo('App\Modules\Sisadm\Models\Sistema', 'id_sistema', 'id_sistema');
    }

}
