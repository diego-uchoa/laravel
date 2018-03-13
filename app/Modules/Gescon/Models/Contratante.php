<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use App\Modules\Sisadm\Models\Orgao;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contratante
 * @package App\Modules\Gescon\Models
 * @version October 30, 2017, 2:13 pm BRST
 */
class Contratante extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contratante';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contratante';

    public $fillable = [
        'id_orgao'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function representante_contrato()
    {
        return $this->hasOne(ContratanteRepresentante::class,'id_contratante','id_contratante')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function representante()
    {
        return $this->hasOne(ContratanteRepresentante::class,'id_contratante','id_contratante')->where('dt_fim', null);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function representantes()
    {
        return $this->hasMany(ContratanteRepresentante::class,'id_contratante','id_contratante')->orderBy('created_at', 'desc')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function contratanteUsuarios()
    {
        return $this->hasMany(ContratanteUsuario::class,'id_contratante','id_contratante')->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function contratanteAssinantes()
    {
        return $this->hasMany(ContratanteAssinante::class,'id_contratante','id_contratante')->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orgao()
    {   
        return $this->belongsTo(Orgao::class,'id_orgao','id_orgao');
    }
}
