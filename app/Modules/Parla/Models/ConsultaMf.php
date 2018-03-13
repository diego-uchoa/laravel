<?php
namespace App\Modules\Parla\Models;
use App\Models\AuditModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
/**
 * Class ConsultaMf
 * @package App\Modules\Parla\Models
 * @version July 27, 2017, 9:20 pm UTC
 */
class ConsultaMf extends Model
{
    use SoftDeletes;
    protected $table = 'spoa_portal_parla.consulta_mf';
    
    protected $primaryKey = 'id_consulta_mf';
    protected $dates = ['deleted_at'];
    public $fillable = [
        'id_proposicao',
        'id_orgao',
        'id_tipo_consulta',
        'id_tipo_posicao',
        'dt_envio',
        'dt_retorno',
        'no_comissao',
        'nr_prioritario'
    ];
    protected $casts = [
        'id_consulta_mf' => 'integer',
        'id_proposicao' => 'integer',
        'id_orgao' => 'integer',
        'id_tipo_consulta' => 'integer',
        'dt_envio' => 'date',
        'dt_retorno' => 'date'
    ];
    protected $touches = ['proposicao'];
    public function getDtEnvioAttribute(){
        if($this->attributes['dt_envio']) {
            return Carbon::parse($this->attributes['dt_envio'])->format('d/m/Y');
        }
    }
    public function setDtEnvioAttribute($value) {
        if(strlen($value) > 0) {
            try {
                return $this->attributes['dt_envio'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            } catch(\Exception $e) {
                return $this->attributes['dt_envio'] = null;
            }
        }
    }
    public function getDtRetornoAttribute(){
        if($this->attributes['dt_retorno']) {
            return Carbon::parse($this->attributes['dt_retorno'])->format('d/m/Y');
        }
    }
    public function setDtRetornoAttribute($value){
        if(strlen($value) > 0) {
            try {
                return $this->attributes['dt_retorno'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            } catch(\Exception $e) {
                return $this->attributes['dt_retorno'] = null;
            }
        }
    }
    public function getStatusAttribute(){
        if($this->attributes['dt_retorno'] != null && $this->attributes['id_tipo_posicao'] != null) {
            return 'C';
        }
        else if(
            ($this->attributes['nr_prioritario'] == 1 && Carbon::now()->diffInDays(Carbon::parse($this->attributes['dt_envio'])) > 3) ||
            ($this->attributes['nr_prioritario'] == 2 && Carbon::now()->diffInDays(Carbon::parse($this->attributes['dt_envio'])) > 10) ||
            ($this->attributes['nr_prioritario'] == 3 && Carbon::now()->diffInDays(Carbon::parse($this->attributes['dt_envio'])) > 40) 
        ) {
            return 'A';
        }
        else {
            return 'P';
        }
    }
    public function tipoPosicao() {
        return $this->belongsTo(\App\Modules\Parla\Models\TipoPosicao::class,'id_tipo_posicao','id_tipo_posicao')->withTrashed();
    }
    public function tipoConsulta() {
        return $this->belongsTo(\App\Modules\Parla\Models\TipoConsulta::class,'id_tipo_consulta','id_tipo_consulta')->withTrashed();
    }
    public function orgao() {
        return $this->belongsTo(\App\Modules\Sisadm\Models\Orgao::class,'id_orgao','id_orgao')->withTrashed();
    }
    public function proposicao() {
        return $this->belongsTo(Proposicao::class,'id_proposicao','id_proposicao');
    }
}