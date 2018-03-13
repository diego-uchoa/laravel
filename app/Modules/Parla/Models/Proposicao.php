<?php

namespace App\Modules\Parla\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AuditModel;
use App\Modules\Parla\Enum\RegimeTramitacao;
use App\Modules\Parla\Enum\Situacao;
use Carbon\Carbon;

class Proposicao extends AuditModel
{
    use SoftDeletes;

    protected $table = 'spoa_portal_parla.proposicao';
    protected $primaryKey = 'id_proposicao';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'co_codigo_origem',
        'sg_sigla_origem',
        'nr_numero_origem',
        'an_ano_origem',
        'sg_casa_origem',
        'tx_link_origem',
        'tx_terminativo_origem',
        'in_regime_tramitacao_origem',
        'in_situacao_origem',
        'tx_situacao_origem',
        'sn_possui_revisora',
        'co_codigo_revisora',
        'sg_sigla_revisora',
        'nr_numero_revisora',
        'an_ano_revisora',
        'sg_casa_revisora',
        'tx_link_revisora',
        'tx_terminativo_revisora',
        'in_regime_tramitacao_revisora',
        'in_situacao_revisora',
        'tx_situacao_revisora',
        'tx_ementa',
        'tx_palavra_chave',
        'nr_prioritario',
        'tx_norma_gerada',
        'tx_observacao'
    ];

    public function setSnPossuiRevisoraAttribute($value) {
        if(sizeof($value) == 0) {
           $this->attributes['sn_possui_revisora'] = false;
        }
        else {
            $this->attributes['sn_possui_revisora'] = true;
        }
    }

    public function getInRegimeTramitacaoOrigemAttribute() {
        if($this->attributes['in_regime_tramitacao_origem']) {
            return RegimeTramitacao::getValue($this->attributes['in_regime_tramitacao_origem']);
        }
    }

    public function getInRegimeTramitacaoRevisoraAttribute() {
        if($this->attributes['in_regime_tramitacao_revisora']) {
            return RegimeTramitacao::getValue($this->attributes['in_regime_tramitacao_revisora']);
        }
    }

    public function getInSituacaoOrigemAttribute() {
        if($this->attributes['in_situacao_origem']) {
            return Situacao::getValue($this->attributes['in_situacao_origem']);
        }
    }

    public function getInSituacaoRevisoraAttribute() {
        if($this->attributes['in_situacao_revisora']) {
            return Situacao::getValue($this->attributes['in_situacao_revisora']);
        }
    }

    public function getCreatedAtAttribute() {
        if($this->attributes['created_at']) {
            return Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i:s');
        }
    }

    public function getUpdatedAtAttribute() {
        if($this->attributes['updated_at']) {
            return Carbon::parse($this->attributes['updated_at'])->format('d/m/Y H:i:s');
        }
    }

    public function getOrigemAttribute() {
        return $this->attributes['sg_sigla_origem'].' '.$this->attributes['nr_numero_origem'].'/'.$this->attributes['an_ano_origem'];
    }

    public function getRevisoraAttribute() {
        if($this->attributes['sn_possui_revisora']) {
            return $this->attributes['sg_sigla_revisora'].' '.$this->attributes['nr_numero_revisora'].'/'.$this->attributes['an_ano_revisora'];
        }
    }

    public function emendas() {
        return $this->hasMany('App\Modules\Parla\Models\Emenda','id_proposicao','id_proposicao')->orderBy('id_emenda','desc');
    }

    public function substitutivos() {
        return $this->hasMany('App\Modules\Parla\Models\Substitutivo','id_proposicao','id_proposicao')->orderBy('id_substitutivo','desc');
    }

    public function materias_relacionadas() {
        return $this->hasMany('App\Modules\Parla\Models\MateriaRelacionada','id_proposicao','id_proposicao');
    }

    public function apensados() {
        return $this->hasMany('App\Modules\Parla\Models\Apensado','id_proposicao','id_proposicao');
    }

    public function autoria() {
        return $this->hasOne('App\Modules\Parla\Models\Autoria','id_proposicao','id_proposicao');
    }

    public function tramitacoes() {
        return $this->hasMany('App\Modules\Parla\Models\Tramitacao','id_proposicao','id_proposicao')->orderBy('dt_data_tramitacao','desc');
    }

    public function ultima_tramitacao() {
        return $this->hasOne('App\Modules\Parla\Models\Tramitacao','id_proposicao','id_proposicao')->orderBy('dt_data_tramitacao','desc');
    }

    public function consultas() {
        return $this->hasMany('App\Modules\Parla\Models\ConsultaMf','id_proposicao','id_proposicao')->orderBy('updated_at','desc');
    }

    public function respostas() {
        return $this->hasMany('App\Modules\Parla\Models\RespostaMf','id_proposicao','id_proposicao')->orderBy('updated_at','desc');
    }
}