<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;

class SiapeDadoFuncional extends BaseModel
{
    protected $table = 'spoa_portal.siape_dado_funcional';
    protected $primaryKey = 'nr_siape';
    public $incrementing = false;

    protected $fillable= [
        'nr_cpf',
        'co_uorg_exercicio',
        'co_uorg_lotacao',
        'co_upag',
        'co_funcao',
        'dt_ingresso_funcao',
        'nr_cpf_chefia',
        'dt_ingresso_orgao',
        'dt_ocorrencia_exclusao',
        'ds_ocorrencia_exclusao',
        'nr_siape',
        'co_cargo',
        'co_situacao_funcional'
    ];


    public function uorgExercicio()
    {
        return $this->hasOne(Orgao::class,'co_uorg','co_uorg_exercicio');
    }

    public function uorgLotacao()
    {
        return $this->hasOne(Orgao::class,'co_uorg','co_uorg_lotacao');
    }

    public function upag()
    {
        return $this->hasOne(Orgao::class,'co_uorg','co_upag');
    }

    public function chefia()
    {
        return $this->hasOne(SiapeDadoPessoal::class,'nr_cpf','nr_cpf_chefia');
    }

    public function cargo()
    {
        return $this->hasOne(SiapeCargo::class,'co_cargo','co_cargo');
    }    

    public function situacaoFuncional()
    {
        return $this->hasOne(SiapeSituacaoFuncional::class,'co_situacao_funcional','co_situacao_funcional');
    }    

    /**
    * Método responsável por formatar a data de ingresso no orgao
    * @param  String
    */
    public function setDataIngressoOrgao($value)
    {   
        if ($value != "")
        {
        
            $dia = substr($value, 0, 2);
            $mes = substr($value, 2, 2);
            $ano = substr($value, 4, 4);
            
            $this->dt_ingresso_orgao = $ano .'-'. $mes .'-'. $dia;  

        }else{

            $this->dt_ingresso_orgao = null;  
        }
    }

    /**
    * Método responsável por formatar a data de ingresso na função
    * @param  String
    */
    public function setDataIngressoFuncao($value)
    {   
        if ($value != "")
        {
            
            $dia = substr($value, 0, 2);
            $mes = substr($value, 2, 2);
            $ano = substr($value, 4, 4);
            
            $this->dt_ingresso_funcao = $ano .'-'. $mes .'-'. $dia;    

        }else{
            
            $this->dt_ingresso_funcao = null;    

        }
        
    }

    /**
    * Método responsável por formatar a data de ocorrência de exclusão 
    * @param  String
    */
    public function setDataOcorrenciaExclusao($value)
    {   
        if ($value != "")
        {
        
            $dia = substr($value, 0, 2);
            $mes = substr($value, 2, 2);
            $ano = substr($value, 4, 4);
            
            $this->dt_ocorrencia_exclusao = $ano .'-'. $mes .'-'. $dia;

        }else{

            $this->dt_ocorrencia_exclusao = null;
        }
    }
}
