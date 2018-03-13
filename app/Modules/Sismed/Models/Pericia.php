<?php

namespace App\Modules\Sismed\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\AuditModel;
use App\Modules\Sismed\Enum\Situacao;
use App\Modules\Sismed\Enum\TipoPericia;


class Pericia extends AuditModel
{
    use SoftDeletes;

    protected $table = 'spoa_portal_sismed.pericia';
    protected $primaryKey = 'id_pericia';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_atestado',
        'in_tipo_pericia',
        'te_prazo',
        'dt_inicio_afastamento',
        'dt_fim_afastamento',
        'no_laudo_fisico',
        'in_situacao',
        'dt_pericia'
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

    public function getDtPericiaAttribute()
    {
        if($this->attributes['dt_pericia']){
            return Carbon::parse($this->attributes['dt_pericia'])->format('d/m/Y');
        }else{
           return null;
        }

        
    }

    public function setDtPericiaAttribute($value)
    {
        if($value != "" || $value != null){
            $this->attributes['dt_pericia'] = Carbon::createFromFormat('d/m/Y', $value);
        }
        else{
            $this->attributes['dt_pericia'] = null;
        }
    }

    public function getDtCadastroAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function tipoPericia()
    {
        return TipoPericia::getValue($this->attributes['in_tipo_pericia']);
    }

    public function situacao()
    {
        return Situacao::getValue($this->attributes['in_situacao']);
    }

}
