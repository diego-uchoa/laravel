<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\SiapeSituacaoFuncional;
use Illuminate\Support\Collection;
use Exception;

class SiapeSituacaoFuncionalRepository extends AbstractRepository
{

    protected $model;
        
    public function __construct(SiapeSituacaoFuncional $model)
    {
        $this->model = $model;
    }

    /**
    * Grava Situacao Funcional recuperadas do WebService do SIAPE na BD
    * @param  SiapeDadoFuncional $siapeDadoFuncionalWS
    * @return SiapeSituacaoFuncional
    */
    public function store($siapeDadoFuncionalWS)
    {
        $collection = new Collection;

        if ($siapeDadoFuncionalWS){

            foreach ($siapeDadoFuncionalWS as $dadosFuncionais) {
                
                foreach ($dadosFuncionais as $dadoFuncional) {
                    
                    $count = sizeof($dadoFuncional);

                    if ($count > 1)
                    {
                        for ($i = 0; $i < sizeof($dadoFuncional); $i++){
                            
                            $modelSituacaoFuncional = new SiapeSituacaoFuncional;

                            $modelSituacaoFuncional->co_situacao_funcional = $dadoFuncional[$i]->codSitFuncional;
                            $modelSituacaoFuncional->no_situacao_funcional = $dadoFuncional[$i]->nomeSitFuncional;
                            
                            if ($this->findByCodigo($dadoFuncional[$i]->codSitFuncional)->isEmpty()){

                                $modelSituacaoFuncional->save();
                                $collection->push($modelSituacaoFuncional);

                            }

                        }    

                    }else{

                        $modelSituacaoFuncional = new SiapeSituacaoFuncional;

                        $modelSituacaoFuncional->co_situacao_funcional = $dadoFuncional->codSitFuncional;
                        $modelSituacaoFuncional->no_situacao_funcional = $dadoFuncional->nomeSitFuncional;
                        
                        if ($this->findByCodigo($dadoFuncional->codSitFuncional)->isEmpty()){

                            $modelSituacaoFuncional->save();
                            $collection->push($modelSituacaoFuncional);

                        }

                    }

                    return $collection->unique();
                    
                }

            }

        }

        return null;
        
    }    

    /**
    * Recupera a situacao funcional pelo código
    * @param  string $co_situacao_funcional
    * @return SituacaoFuncional
    */
    public function findByCodigo($co_situacao_funcional)
    {
        $situacaoFuncional = $this->findBy([['co_situacao_funcional', '=' , $co_situacao_funcional]]);

        return $situacaoFuncional;
    }

}