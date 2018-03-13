<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Municipio;

/**
 * Class Orgao
 * @package App\Modules\Sisadm\Models
 * @version August 15, 2017, 6:05 pm UTC
 */
class Orgao extends Model
{
    protected $table = 'spoa_portal.orgao';
    protected $primaryKey = 'id_orgao';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $fillable = [
        'sg_orgao',
        'no_orgao',
        'id_municipio',
        'co_uorg',
        'co_siafi',
        'sn_oficial',
        'nr_ordem',
        'id_orgao_id',
        'nr_nivel'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio', 'id_municipio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function usuarios()
    {
        return $this->hasMany(User::class,'id_orgao', 'id_orgao');
    }

}
