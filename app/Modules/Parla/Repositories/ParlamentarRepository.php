<?php
namespace App\Modules\Parla\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Parla\Models\Parlamentar;
use App\Helpers\UtilHelper;
use Exception;

class ParlamentarRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Parlamentar $model)
    {
        $this->model = $model;
    }

    /**
    * Grava dados do parlamentar recuperados do WebService da Camara na BD
    * @param  array $dadosBasicosParlamentar
    * @return Parlamentar
    */
    public function store($dadosBasicosParlamentar)
    {   
        try{

            $this->model = new Parlamentar();

            if ($dadosBasicosParlamentar){
                $this->model->co_parlamentar = $dadosBasicosParlamentar['co_parlamentar'];
                $this->model->no_parlamentar = $dadosBasicosParlamentar['no_parlamentar'];
                $this->model->no_civil = $dadosBasicosParlamentar['no_civil'];
                $this->model->in_sexo = $dadosBasicosParlamentar['in_sexo'];
                $this->model->in_cargo = $dadosBasicosParlamentar['in_cargo'];
                $this->model->dt_nascimento = $dadosBasicosParlamentar['dt_nascimento'];
                $this->model->sg_uf_parlamentar = $dadosBasicosParlamentar['sg_uf_parlamentar'];
                $this->model->ds_email = $dadosBasicosParlamentar['ds_email'];
                $this->model->sn_exercicio = $dadosBasicosParlamentar['sn_exercicio'];
                $this->model->aq_foto = $dadosBasicosParlamentar['aq_foto'];

                $parlamentarBD = $this->findParlamentarByCoParlamentar($dadosBasicosParlamentar['co_parlamentar']);

                if (!$parlamentarBD->isEmpty()){

                    $array_dadosParlamentar = $this->__ParlamentartoArray($this->model);
                    $parlamentarBD[0]->update($array_dadosParlamentar);
                    return $parlamentarBD[0];

                }else{
                
                        $this->model->save();
                        return $this->model;

                }

            }

        }catch (Exception $e){

            throw new Exception('Erro: Não foi possível atualizar o parlamentar.', 999);

        }

        return null;
    }    

    /**
    * Transforma o retorno do WS em formato de array
    * @param  array $dadosParlamentar
    * @return array
    */
    private function __ParlamentartoArray($dadosParlamentar)
    {
        return [

            'co_parlamentar' => $dadosParlamentar->co_parlamentar,
            'no_parlamentar' => $dadosParlamentar->no_parlamentar,
            'no_civil' => $dadosParlamentar->no_civil,
            'in_sexo' => $dadosParlamentar->in_sexo == 'Masculino' ? 'M' : 'F',
            'in_cargo' => $dadosParlamentar->in_cargo == 'Deputado' ? 'DEP' : 'SEN',
            'dt_nascimento' => $dadosParlamentar->dt_nascimento,
            'sg_uf_parlamentar' => $dadosParlamentar->sg_uf_parlamentar,
            'ds_email' => $dadosParlamentar->ds_email,
            'sn_exercicio' => $dadosParlamentar->sn_exercicio == 'Sim' ? true : false,
            'aq_foto' => $dadosParlamentar->aq_foto,
        ];
    }

    /**
    * Recuperar dados do parlamentar no BD
    * @param  string $coParlamentar
    * @return Array
    */
    public function findParlamentarByCoParlamentar($coParlamentar)
    {
        $parlamentar = $this->findBy([['co_parlamentar', '=' , $coParlamentar]]);
        return $parlamentar;
    }

}