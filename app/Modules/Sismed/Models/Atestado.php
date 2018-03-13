<?php

namespace App\Modules\Sismed\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\AuditModel;
use App\Modules\Sismed\Enum\Situacao;
use App\Modules\Sismed\Enum\AreaAtendimento;
use App\Modules\Sismed\Enum\TipoAfastamento;
use App\Modules\Sismed\Enum\TipoPericia;


class Atestado extends AuditModel
{
    use SoftDeletes;

    protected $table = 'spoa_portal_sismed.atestado';
    protected $primaryKey = 'id_atestado';
    protected $dates = ['deleted_at'];

    protected $fillable= [
        'id_servidor',
        'id_controle_ciclo',
        'in_area_atendimento',
        'in_tipo_afastamento',
        'in_tipo_pericia',
        'te_prazo',
        'nr_crm',
        'no_medico',
        'dt_inicio_afastamento',
        'dt_fim_afastamento',
        'no_atestado_fisico',
        'no_laudo_fisico',
        'in_situacao',
        'tx_observacao',
        'id_controle_ciclo'
    ];

    public function getDtInicioAfastamentoAttribute()
    {
        return Carbon::parse($this->attributes['dt_inicio_afastamento'])->format('d/m/Y');
    }

    public function setDtInicioAfastamentoAttribute($value)
    {
        $this->attributes['dt_inicio_afastamento'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDtFimAfastamentoAttribute()
    {
        return Carbon::parse($this->attributes['dt_fim_afastamento'])->format('d/m/Y');
    }

    public function setDtFimAfastamentoAttribute($value)
    {
        $this->attributes['dt_fim_afastamento'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDtCadastroAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function servidor()
    {
        return $this->hasOne(Servidor::class,'id_servidor','id_servidor');
    }

    public function areaAtendimento()
    {
        return AreaAtendimento::getValue($this->attributes['in_area_atendimento']);
    }

    public function tipoAfastamento()
    {
        return TipoAfastamento::getValue($this->attributes['in_tipo_afastamento']);
    }

    public function tipoPericia()
    {
        return TipoPericia::getValue($this->attributes['in_tipo_pericia']);
    }

    public function situacao()
    {
        return Situacao::getValue($this->attributes['in_situacao']);
    }

    public function ciclo()
    {
        return $this->hasOne(ControleCiclo::class,'id_controle_ciclo','id_controle_ciclo');
    }

    public function pericias()
    {
        return $this->hasMany(Pericia::class,'id_atestado','id_atestado');
    }

}
