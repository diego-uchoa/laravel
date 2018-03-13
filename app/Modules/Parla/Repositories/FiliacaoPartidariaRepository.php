<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\FiliacaoPartidaria;
use App\Helpers\UtilHelper;
use Exception;
use DB;

class FiliacaoPartidariaRepository extends AbstractRepository
{
    protected $model;

    public function __construct(FiliacaoPartidaria $model)
    {
        $this->model = $model;
    }

    /**
    * Grava dados da filiacao partidária do parlamentar recuperados do WebService da Camara na BD
    * @param  array $id_parlamentar
    * @param  array $dadosFiliacaoPartidaria
    * @return FiliacaoPartidaria
    */
    public function store($id_parlamentar, $dadosFiliacaoPartidaria)
    {
        try{

            $this->_destroyFiliacaoPartidaria($id_parlamentar);

            foreach ($dadosFiliacaoPartidaria as $filiacaoPartidaria) {
                
                $this->model = new FiliacaoPartidaria();
                $this->model->id_parlamentar = $id_parlamentar;
                $this->model->sg_partido = $filiacaoPartidaria['sg_partido'];
                $this->model->no_partido = $filiacaoPartidaria['no_partido'];
                $this->model->dt_filiacao_inicio = $filiacaoPartidaria['dt_filiacao_inicio'];
                $this->model->dt_filiacao_fim = $filiacaoPartidaria['dt_filiacao_fim'];

                $this->model->save();

            }

        }catch (Exception $e){

            throw new Exception('Erro: Não foi possível atualizar a filiação partidária do parlamentar.', 999);

        }

        return $this->model;
    }    

    
    /**
    * Grava dados das filiações partidárias parlamentar recuperadas do WebService da Camara na BD
    * @param array $dadosBasicosParlamentar
    * @return Parlamentar
    */
    private function _destroyFiliacaoPartidaria($id_parlamentar)
    { 

        try{

            FiliacaoPartidaria::where('id_parlamentar', '=', $id_parlamentar)->delete();

        }catch(Exception $e){
            
            throw new Exception('Erro: Não foi possível excluir a(s) filiação(ões) partidária(s) do parlamentar.', 999);

        }
    
    }  

    public function findByIdParlamentar($idParlamentar)
    {
        return $this->findByAttribute('id_parlamentar', $idParlamentar);      
    } 

}