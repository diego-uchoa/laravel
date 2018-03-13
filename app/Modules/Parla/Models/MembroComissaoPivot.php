<?php

namespace App\Modules\Parla\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Modules\Parla\Enum\TipoPosicionamento;

/**
 * Class MembroComissao
 * @package App\Modules\Parla\Models
 * @version September 19, 2017, 1:25 pm UTC
 */
class MembroComissaoPivot extends Pivot
{
    use SoftDeletes;

    protected $table = 'spoa_portal_parla.membro_comissao';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_membro_comissao';

    public $fillable = [
        'id_comissao',
        'id_parlamentar',
        'in_cargo'
    ];

    /**
     * Os atributos que devem ser moldados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id_membro_comissao' => 'integer',
        'id_comissao' => 'integer',
        'id_parlamentar' => 'integer',
        'in_cargo' => 'string'
    ];

    /**
     * Regras de Validação
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function getInTipoAttribute() {
        if($this->attributes['in_tipo']) {
            return TipoPosicionamento::getValue($this->attributes['in_tipo']);
        }
    }
}
