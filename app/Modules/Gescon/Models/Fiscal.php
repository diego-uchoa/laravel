<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MaskHelper;

/**
 * Class Fiscal
 * @package App\Modules\Gescon\Models
 * @version November 20, 2017, 8:54 am BRST
 */
class Fiscal extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.fiscal';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_fiscal';

    public $fillable = [
        'nr_cpf',
        'no_fiscal',
        'nr_siape',
        'ds_email',
        'nr_telefone'
    ];

    /**
     * Os atributos que devem ser moldados para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'id_fiscal' => 'integer',
        'nr_cpf' => 'string',
        'no_fiscal' => 'string',
        'nr_siape' => 'string',
        'ds_email' => 'string',
        'nr_telefone' => 'string'
    ];

    public function setNrCpfAttribute($value)
    {
        $this->attributes['nr_cpf'] = MaskHelper::removeMascaraCpf($value);
    }

    public function getNrCpfAttribute()
    {
        if (strlen($this->attributes['nr_cpf']) == 11) {
            return MaskHelper::aplicaMascara($this->attributes['nr_cpf'],'###.###.###-##');    
        }
    }
    
}
