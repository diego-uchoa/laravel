<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Sisadm\Models\User;
use Carbon\Carbon;

/**
 * Class ContratanteRepresentante
 * @package App\Modules\Gescon\Models
 * @version October 30, 2017, 2:15 pm BRST
 */
class ContratanteUsuario extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contratante_usuario';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contratante_usuario';

    public $fillable = [
        'id_contratante',
        'id_usuario'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function contratante()
    {
        return $this->BelongsTo(Contratante::class,'id_contratante','id_contratante');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->BelongsTo(User::class,'id_usuario','id_usuario');
    }
}
