<?php

namespace App\Modules\Gescon\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MaskHelper;

/**
 * Class Contratada
 * @package App\Modules\Gescon\Models
 * @version September 20, 2017, 2:29 pm UTC
 */
class Contratada extends Model
{
    use SoftDeletes;

    protected $table = 'spoa_portal_gescon.contratada';
    

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_contratada';

    public $fillable = [
        'in_tipo_contratada',
        'nr_cpf_cnpj',
        'no_razao_social',
        'ed_cep_logradouro',
        'ed_logradouro',
        'ed_numero_logradouro',
        'ed_complemento_logradouro',
        'ed_bairro_logradouro',
        'id_municipio_logradouro',
        'no_representante',
        'nr_telefone',
        'ds_email'
    ];

    public function getNrCpfCnpjAttribute()
    {
        if (strlen($this->attributes['nr_cpf_cnpj']) == 11) {
            return MaskHelper::aplicaMascara($this->attributes['nr_cpf_cnpj'],'###.###.###-##');    
        }else{
            return MaskHelper::aplicaMascara($this->attributes['nr_cpf_cnpj'],'##.###.###/####-##');    
        }
        
    }

    public function setNrCpfCnpjAttribute($value)
    {
        $value = str_replace("." , "" , $value); 
        $value = str_replace("-" , "" , $value);
        $value = str_replace("/" , "" , $value);

        $this->attributes['nr_cpf_cnpj'] = $value;
    }

    public function setEdNumeroLogradouroAttribute($value)
    {
        if ($value != ""){
            $value = str_replace("." , "" , $value);
            $value = str_replace("," , "" , $value);
        }

        $this->attributes['ed_numero_logradouro'] = $value;    
    }

    public function getDescricaoTipoContratadaAttribute()
    {
        if ($this->attributes['in_tipo_contratada'] == 'PJ'){
            return "Pessoa Jurídica";
        }
        else{
            return "Pessoa Física";   
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function municipio()
    {
        return $this->belongsTo(\App\Models\Municipio::class, 'id_municipio_logradouro', 'id_municipio');
    }
}
