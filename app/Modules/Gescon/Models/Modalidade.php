<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modalidade
 * @package App\Modules\Gescon\Models
 * @version September 20, 2017, 2:29 pm UTC
 */
class Modalidade extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.modalidade';
    
    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_modalidade';

    public $fillable = [
        'no_modalidade'
    ];

}
