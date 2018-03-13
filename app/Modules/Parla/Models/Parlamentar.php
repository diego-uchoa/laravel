<?php

namespace App\Modules\Parla\Models;

use App\Models\BaseModel;
use App\Helpers\UtilHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Modules\Parla\Enum\TipoCargo;
use App\Modules\Parla\Enum\TipoPosicionamento;

class Parlamentar extends BaseModel
{
    protected $table = 'spoa_portal_parla.parlamentar';
    protected $primaryKey = 'id_parlamentar';
    protected $dates = [
            'dt_nascimento'
    ];

    protected $fillable= [
        'co_parlamentar',
        'no_parlamentar',
        'no_civil',
        'in_sexo', 
        'in_cargo',
        'dt_nascimento',
        'sg_uf_parlamentar',
        'ds_email',
        'sn_exercicio',
        'aq_foto',
        'in_posicionamento'
    ];

    public function getInSexoAttribute()
    {
        return $this->attributes['in_sexo'] == 'M' ? 'Masculino' : 'Feminino';
    }

    public function getInCargoAttribute()
    {
        return $this->attributes['in_cargo'] == 'DEP' ? 'Deputado' : 'Senador';
    }

    public function getDtNascimentoAttribute()
    {
        return Carbon::parse($this->attributes['dt_nascimento'])->format('d/m/Y');
    }

    public function setDtNascimentoAttribute($value)
    {
        if (strlen($value) > 0){
            try{
                return $this->attributes['dt_nascimento'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }catch(\Exception $e){
                return $this->attributes['dt_nascimento'] = $value;
            }
        }
    }

    public function getSnExercicioAttribute()
    {
        return $this->attributes['sn_exercicio'] ? 'Sim' : 'Não';
    }

    public function getPartidoAtualAttribute()
    {
        foreach ($this->filiacoes as $filiacao) {
            if($filiacao->dt_filiacao_fim == null) {
                return $filiacao->sg_partido;
            }
        }
        return 'Sem partido';

    } 

    public function getCargoComissaoAttribute() {
        if($this->pivot->in_cargo) {
            return TipoCargo::getValue($this->pivot->in_cargo);
        }
    }

    public function getNoPosicionamentoAttribute() {
        if($this->attributes['in_posicionamento']) {
            return TipoPosicionamento::getValue($this->attributes['in_posicionamento']);
        }
    }

    public function getSgPosicionamentoComissaoAttribute() {
        return $this->pivot->in_posicionamento_comissao;
    }

    public function getPosicionamentoComissaoAttribute() {
        if($this->pivot->in_posicionamento_comissao) {
            return TipoPosicionamento::getValue($this->pivot->in_posicionamento_comissao);
        }
    }

    public function filiacoes()
    {
        return $this->hasMany(FiliacaoPartidaria::class,'id_parlamentar','id_parlamentar');
    }

    public function autorias()
    {
        return $this->hasMany(Autoria::class,'id_parlamentar','id_parlamentar');
    }

    public function comissoes()
    {
        return $this->belongsToMany(Comissao::class,'spoa_portal_parla.membro_comissao','id_parlamentar','id_comissao')->withPivot('in_cargo','in_posicionamento_comissao');
    }
}
