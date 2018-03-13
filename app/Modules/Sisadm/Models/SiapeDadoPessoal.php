<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class SiapeDadoPessoal extends BaseModel
{
    protected $table = 'spoa_portal.siape_dado_pessoal';
    protected $primaryKey = 'nr_cpf';
    public $incrementing = false;

    protected $fillable= [
        'id_usuario',
        'nr_cpf',
        'no_pessoa',
        'dt_nascimento',
        'in_estado_civil',
        'no_mae',
        'no_pai',
        'in_sexo',
        'sg_uf_nascimento',
        'no_municipio_nascimento',
        'nr_pis_pasep',
        'ds_foto'
    ];

    /**
    * Método responsável por formatar a data de nascimento da pessoa
    * @param  String dataNascimento
    */
    public function setDataNascimento($value)
    {   
        $dia = substr($value, 0, 2);
        $mes = substr($value, 2, 2);
        $ano = substr($value, 4, 4);
        
        $this->dt_nascimento = $ano .'-'. $mes .'-'. $dia;
    }
}
