<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\SiapeDadoFuncional;
use MaskHelper;
use Illuminate\Support\Collection;
use SoapClient;
use Exception;

class SiapeDadoFuncionalRepository extends AbstractRepository
{

    protected $model;
        
    public function __construct(SiapeDadoFuncional $model)
    {
        $this->model = $model;
    }

    /**
    * Grava dados funcionais da pessoa recuperados do WebService do SIAPE na BD
    * @param  string $cpf
    * @param  array $siapeDadoFuncional
    * @return Collection SiapeDadoFuncional
    */
    public function store($cpf, $siapeDadoFuncionalWS)
    {
        $collection = new Collection;

        if ($siapeDadoFuncionalWS){

            foreach ($siapeDadoFuncionalWS as $dadosFuncionais) {
                
                foreach ($dadosFuncionais as $dadoFuncional) {
                    
                    $count = sizeof($dadoFuncional);

                    if ($count > 1)
                    {
                        for ($i = 0; $i < sizeof($dadoFuncional); $i++){
                            
                            $pessoaBD = $this->findBySiape($dadoFuncional[$i]->matriculaSiape);
                            $array_SiapeDadoFuncional = $this->__SiapeDadoFuncionaltoArray($cpf, $dadoFuncional[$i]);

                            if (!$pessoaBD->isEmpty()){

                                $pessoaBD[0]->update($array_SiapeDadoFuncional);
                                $collection->push($pessoaBD[0]);

                            }else{

                                $siapeDadoFuncional = SiapeDadoFuncional::create($array_SiapeDadoFuncional);
                                $collection->push($siapeDadoFuncional);

                            }

                        }    

                        return $collection->unique()->sortBy('dt_ocorrencia_exclusao');

                    }else{

                        $pessoaBD = $this->findBySiape($dadoFuncional->matriculaSiape);
                        $array_SiapeDadoFuncional = $this->__SiapeDadoFuncionaltoArray($cpf, $dadoFuncional);

                        if (!$pessoaBD->isEmpty()){

                            $pessoaBD[0]->update($array_SiapeDadoFuncional);
                            $collection->push($pessoaBD[0]);

                        }else{

                            $siapeDadoFuncional = SiapeDadoFuncional::create($array_SiapeDadoFuncional);
                            $collection->push($siapeDadoFuncional);

                        }

                        return $collection->unique()->sortBy('dt_ocorrencia_exclusao');

                    }
                    
                }

            }

        }

        return null;
        
    }    

    /**
    * Transforma o retorno do WS em formato de array
    * @param  string $cpf
    * @param  array $siapeDadoFuncionalWS
    * @return array
    */
    private function __SiapeDadoFuncionaltoArray($cpf, $siapeDadoFuncionalWS)
    {
        $cpfChefia = MaskHelper::removeMascaraCpf($siapeDadoFuncionalWS->cpfChefiaImediata);
        
        return [

            'nr_cpf' => $cpf,
            'co_uorg_exercicio' => $siapeDadoFuncionalWS->codUorgExercicio ? $siapeDadoFuncionalWS->codUorgExercicio : null,
            'co_uorg_lotacao' => $siapeDadoFuncionalWS->codUorgLotacao ? $siapeDadoFuncionalWS->codUorgLotacao : null,
            'co_upag' => $siapeDadoFuncionalWS->codUpag ? substr($siapeDadoFuncionalWS->codUpag, -9) : null,
            'co_funcao' => $siapeDadoFuncionalWS->codFuncao,
            'dt_ingresso_funcao' => $this->_formataData($siapeDadoFuncionalWS->dataIngressoFuncao),
            'dt_ocorrencia_exclusao' => $this->_formataData($siapeDadoFuncionalWS->dataOcorrExclusao),
            'ds_ocorrencia_exclusao' => $siapeDadoFuncionalWS->nomeOcorrExclusao,
            'nr_cpf_chefia' => $cpfChefia,
            'dt_ingresso_orgao' => $this->_formataData($siapeDadoFuncionalWS->dataOcorrIngressoOrgao),
            'nr_siape' => $siapeDadoFuncionalWS->matriculaSiape,
            'co_cargo' => $siapeDadoFuncionalWS->codCargo ? $siapeDadoFuncionalWS->codCargo : null,
            'co_situacao_funcional' => $siapeDadoFuncionalWS->codSitFuncional ? $siapeDadoFuncionalWS->codSitFuncional : null,
        ];
    }

    /**
    * Recuperar dados da pessoa no BD na tabela DadosFuncionais
    * @param  string $cpf
    * @return Array
    */
    public function findBySiape($siape)
    {
        $pessoa = $this->findBy([['nr_siape', '=', $siape]]);

        return $pessoa;
    }

    /**
    * Método responsável por formatar a data de acordo com o BD
    * @param  String data
    */
    private function _formataData($data)
    {   
        if ($data != "")
        {
            
            $dia = substr($data, 0, 2);
            $mes = substr($data, 2, 2);
            $ano = substr($data, 4, 4);
            
            return $ano .'-'. $mes .'-'. $dia;    

        }else{
            
            return null;    

        }
    }

}