<?php

namespace App\Modules\Sismed\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AuditModel;
use MaskHelper;
use App\Modules\Sisadm\Models\SiapeCargo;
use Carbon\Carbon;
use App\Modules\Sismed\Enum\RegimeJuridico;

class Servidor extends AuditModel
{
    use SoftDeletes;
    
    protected $table = 'spoa_portal_sismed.servidor';
    protected $primaryKey = 'id_servidor';
    protected $dates = ['deleted_at'];

    protected $fillable= [
        'nr_cpf',
        'no_servidor',
        'nr_rg',
        'dt_nascimento', 
        'ds_email',
        'tx_telefone_unidade',
        'tx_telefone_celular',
        'tx_telefone_residencial',
        'nr_siape',
        'no_orgao',
        'no_unidade_lotacao',
        'no_unidade_exercicio',
        'co_prontuario',
        'in_sexo',
        'no_cargo',
        'in_regime_juridico',
        'in_situacao_servidor',
        'tx_local_arquivo_geral'
    ];

    public function getNrCpfAttribute()
    {
        return MaskHelper::aplicaMascara($this->attributes['nr_cpf'],'###.###.###-##');
    }

    public function setNrCpfAttribute($value)
    {
        $value = str_replace("." , "" , $value); // remove os pontos
        $value = str_replace("-" , "" , $value); // remove o hifen

        $this->attributes['nr_cpf'] = $value;
    }

    public function getDtNascimentoAttribute()
    {
        return Carbon::parse($this->attributes['dt_nascimento'])->format('d/m/Y');
    }

    public function setDtNascimentoAttribute($value)
    {
        $this->attributes['dt_nascimento'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function atestado()
    {
        return $this->hasMany(Atestado::class,'id_servidor','id_servidor');
    }

    public function regimeJuridico()
    {
        return RegimeJuridico::getValue($this->attributes['in_regime_juridico']);
    }

}
