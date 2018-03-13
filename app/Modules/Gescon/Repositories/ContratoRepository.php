<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Contrato;
use App\Repositories\AbstractRepository;
use Auth;

class ContratoRepository extends AbstractRepository
{
    public function __construct(Contrato $model)
    {
        $this->model = $model;
    }

    /**
    * Recuperar todos os registros ativos dos contratos, ordenando-os pelo ano
    * @return Array Contratos
    */
    public function findAllOrderByDataVencimento()
    {
        if(Auth::user()->hasRole('GESCON-Gestor')){
            return $this->model->whereNull('dt_encerramento')->orderBy('dt_cessacao')->get();
        }else{
            return $this->findContratosByUasg();
        }
    }   

    /**
    * Recuperar todos os registros ativos dos contratos associados a UASG que o servidor está associado
    * @return Array Contratos
    */
    public function findContratosByUasg()
    {
        $contratos = $this->model->whereHas('contratante.contratanteUsuarios', function($query) {
            $query->where('id_usuario', Auth::user()->id_usuario);    
            $query->whereNull('dt_encerramento');
        })->get();
        
        return $contratos;
    }  

    /**
    * Recuperar o contrato por ID da UASG que o usuário possa alterar
    * @return Array Contratos
    */
    public function findContratoUasgById($id)
    {
        $contrato = $this->model->whereHas('contratante.contratanteUsuarios', function($query) use ($id) {
            $query->where('id_usuario', Auth::user()->id_usuario);    
            $query->whereNull('dt_encerramento');
            $query->where('id_contrato', $id);    
        })->get();
        
        return $contrato->first();
    }       

    /**
    * Recuperar todos os registros do contrato ativo por Numero do Contrato e Uasg
    * @return Array Contratos
    */
    public function findContratoByNuContratoCoUasg($nu_contrato, $uasg)
    {
        $contrato = $this->findBy([['nr_contrato','=', $nu_contrato],['co_uasg', '=', $uasg]]);
        if ($contrato->first()){
            $contrato->first()->rota_edicao_contrato = $contrato->first()->rota_edicao_contrato;    
        }
        return $contrato->first();
    }   

    /**
    * Recuperar todos os registros do contrato excluído por Numero do Contrato e Uasg
    * @return Array Contratos
    */
    public function findContratoExcluidoByNuContratoCoUasg($nu_contrato, $uasg)
    {
        $contrato = $this->findDeleted([['nr_contrato','=', $nu_contrato],['co_uasg', '=', $uasg]]);
        return $contrato->first();
    }   

    /**
    * Recuperar todos os registros dos contratos com dt_cessacao dentro do período, podendo filtrar pela UASG que o servidor estiver associado
    * @return Collection Contratos
    */
    public function filterPeriodoDtCessacao($dataInicio, $dataFim)
    {
        if (Auth::user()){
            if(Auth::user()->hasRole('GESCON-Gestor')){
                $contratos = $this->findAllByPeriodoDtCessacao($dataInicio, $dataFim);
            }else{
                $contratos = $this->findByUasgPeriodoDtCessacao($dataInicio, $dataFim);
            }
        }else{
            $contratos = $this->findAllByPeriodoDtCessacao($dataInicio, $dataFim);
        }
        
        return $contratos;
    }

    /**
    * Recuperar todos os registros dos contratos com dt_cessacao dentro do período
    * @return Collection Contratos
    */
    public function findAllByPeriodoDtCessacao($dataInicio, $dataFim)
    {
        $andCriteria = array();
        $andCriteria[] = ['dt_cessacao', '>=', $dataInicio];
        $andCriteria[] = ['dt_cessacao', '<=', $dataFim];
        $andCriteria[] = ['dt_encerramento', 'is', 'null'];
        return $this->findBy($andCriteria, null, [['dt_cessacao', 'asc']]);
    }

    /**
    * Recuperar todos os registros dos contratos com dt_cessacao dentro do período da Uasg associada ao Servidor
    * @return Collection Contratos
    */
    public function findByUasgPeriodoDtCessacao($dataInicio, $dataFim)
    {
        $contratos = $this->model->whereHas('contratante.contratanteUsuarios', function($query) {
            $query->where('id_usuario', Auth::user()->id_usuario);    
        })->where('dt_cessacao', '>=', $dataInicio)
            ->where('dt_cessacao', '<=', $dataFim)
            ->whereNull('dt_encerramento')
            ->get();    

        return $contratos;
    }
    
}
