<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\SiapeCargo;
use Illuminate\Support\Collection;
use Exception;

class SiapeCargoRepository extends AbstractRepository
{

    protected $model;
        
    public function __construct(SiapeCargo $model)
    {
        $this->model = $model;
    }

    /**
    * Grava cargos recuperados do WebService do SIAPE na BD
    * @param  SiapeDadoFuncional $siapeDadoFuncionalWS
    * @return SiapeCargo
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
                            
                            if ($dadoFuncional[$i]->codCargo != "")
                            {
                                $modelCargo = new SiapeCargo;

                                $modelCargo->co_cargo = $dadoFuncional[$i]->codCargo;
                                $modelCargo->no_cargo = $dadoFuncional[$i]->nomeCargo;
                                
                                if ($this->findByCodigo($dadoFuncional[$i]->codCargo)->isEmpty()){

                                    $modelCargo->save();
                                    $collection->push($modelCargo);

                                }    
                            }

                        }    

                    }else{

                        if ($dadoFuncional->codCargo != "")
                        {
                            $modelCargo = new SiapeCargo;

                            $modelCargo->co_cargo = $dadoFuncional->codCargo;
                            $modelCargo->no_cargo = $dadoFuncional->nomeCargo;
                            
                            if ($this->findByCodigo($dadoFuncional->codCargo)->isEmpty()){

                                $modelCargo->save();
                                $collection->push($modelCargo);

                            }
                        }

                    }

                    return $collection->unique();
                    
                }

            }

        }

        return null;
        
    }    

    /**
    * Recupera o Cargo pelo Código
    * @param  integer $co_cargo
    * @return Cargo
    */
    public function findByCodigo($co_cargo)
    {
        $cargo = $this->findBy([['co_cargo', '=' , $co_cargo]]);

        return $cargo;
    }

}