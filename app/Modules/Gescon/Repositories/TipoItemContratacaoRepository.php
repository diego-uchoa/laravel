<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\TipoItemContratacao;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class TipoItemContratacaoRepository extends AbstractRepository
{
    public function __construct(TipoItemContratacao $model)
    {
        $this->model = $model;
    }

    /**
    * Recuperar todos os registros ativos dos tipos de itens de contratação, ordenando-os pelo Objeto
    * @return Array TipoItemContratacao
    */
    public function findAllOrderByObjeto()
    {
        $tipos = $this->findAll(['in_objeto']);
        return $tipos;
    }	

    /**
    * Retorna os Tipos de Itens de Contratação de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo SELECT2
    * @param  String $paramatro
    * @param  String $objeto
    */
    public function prepareListaSelect2ByNome($parametro, $objeto)
    {
        $listaTipos = [];    
        $listaTipos[] = ['text' => 'SELECIONE', 'id' => null];
        
        $tipos = DB::table('spoa_portal_gescon.tipo_item_contratacao')
                            ->select('id_tipo_item_contratacao','ds_tipo_item_contratacao')
                            ->where('in_objeto', '=', $objeto)
                            ->where(function ($query) use ($parametro) {
                                $query->where(DB::raw('upper(ds_tipo_item_contratacao)'), 'like', '%'. strtoupper($parametro) .'%');
                            })                
                            ->get();            
        foreach ($tipos as $tipo) {
            $listaTipos[] = ['text' => $tipo->ds_tipo_item_contratacao, 'id' => $tipo->id_tipo_item_contratacao];
        }    
        return $listaTipos;        
    }    

    /**
    * Retorna os Tipos de Itens de Contratação de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo CHOSEN
    * @param  String $paramatro
    * @param  String $objeto
    */
    public function prepareListaChosenByNome($objeto)
    {
        $listaTipos = [];    
        
        $listaTipos[''] = 'SELECIONE';
        $tipos = DB::table('spoa_portal_gescon.tipo_item_contratacao')
                            ->select('id_tipo_item_contratacao','ds_tipo_item_contratacao')
                            ->where('in_objeto', '=', $objeto)
                            ->get();            
        foreach ($tipos as $tipo) {
            $listaTipos[$tipo->id_tipo_item_contratacao] = $tipo->ds_tipo_item_contratacao;
        }    
        return $listaTipos;        
    }    
}
