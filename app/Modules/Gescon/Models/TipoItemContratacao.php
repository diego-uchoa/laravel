<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Gescon\Enum\ObjetoContrato;

/**
 * Class TipoItemContratacao
 * @package App\Modules\Gescon\Models
 * @version November 20, 2017, 8:54 am BRST
 */
class TipoItemContratacao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.tipo_item_contratacao';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_tipo_item_contratacao';

    public $fillable = [
        'in_objeto',
        'ds_tipo_item_contratacao'
    ];

    public function tipoObjeto()
    {
        return ObjetoContrato::getValue($this->attributes['in_objeto']);
    }
}
