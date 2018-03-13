<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Gescon\Enum\ObjetoContrato;

/**
 * Class UnidadeMedidaItemContratacao
 * @package App\Modules\Gescon\Models
 * @version December 12, 2017, 2:53 pm BRST
 */
class UnidadeMedidaItemContratacao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.unidade_medida_item_contratacao';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_unidade_medida_item_contratacao';

    public $fillable = [
        'in_objeto',
        'ds_unidade_medida_item_contratacao',
        'sg_unidade_medida_item_contratacao'
    ];

    public function tipoObjeto()
    {
        return ObjetoContrato::getValue($this->attributes['in_objeto']);
    }
}
