<?php

namespace App\Modules\Parla\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Parla\Enum\TipoComissao;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Modules\Parla\Enum\TipoCargo;
use App\Modules\Parla\Enum\TipoPosicionamento;

/**
 * Class Comissao
 * @package App\Modules\Parla\Models
 * @version September 15, 2017, 7:44 pm UTC
 */
class Comissao extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_parla.comissao';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_comissao';

    public $fillable = [
        'co_comissao',
        'sg_casa',
        'sg_comissao',
        'no_comissao',
        'in_tipo',
        'in_posicionamento_comissao'
    ];

    /**
     * Os atributos que devem ser moldados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id_comissao' => 'integer',
        'co_comissao' => 'integer',
        'sg_casa' => 'string',
        'sg_comissao' => 'string',
        'no_comissao' => 'string',
        'in_tipo' => 'string',
        'in_posicionamento_comissao' => 'string'
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
            return TipoComissao::getValue($this->attributes['in_tipo']);
        }
    }

    public function getNoCasaAttribute() {
        if($this->attributes['sg_casa']) {
            if($this->attributes['sg_casa'] == 'CD') {
                return 'Câmara dos Deputados';
            }
            else if($this->attributes['sg_casa'] == 'SF') {
                return 'Senado Federal';
            }
        }
    }

    public function getCargoComissaoAttribute() {
        if($this->pivot->in_cargo) {
            return TipoCargo::getValue($this->pivot->in_cargo);
        }
    }

    public function getPosicionamentoComissaoAttribute() {
        if($this->pivot->in_posicionamento_comissao) {
            return TipoPosicionamento::getValue($this->pivot->in_posicionamento_comissao);
        }
    }

    public function getSgPosicionamentoComissaoAttribute() {
        if($this->pivot->in_posicionamento_comissao) {
            return $this->pivot->in_posicionamento_comissao;
        }
    }

    public function membros() {
        return $this->belongsToMany(Parlamentar::class,'spoa_portal_parla.membro_comissao','id_comissao','id_parlamentar')->withPivot('in_cargo','in_posicionamento_comissao');
    }
}
