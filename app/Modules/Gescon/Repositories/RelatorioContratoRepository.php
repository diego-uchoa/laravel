<?php

namespace App\Modules\Gescon\Repositories;

use App\Modules\Gescon\Models\Contrato;
use App\Repositories\AbstractRepository;
use Carbon\Carbon;
use Auth;

class RelatorioContratoRepository extends AbstractRepository
{
    
    public function __construct(Contrato $model)
    {
        $this->model = $model;
    }    

    /**
    * Método responsável por recuperar os contratos de acordo com os parâmetros informados
    * 
    * @param $parametros
    *
    * @return Contrato
    */ 
    public function findContratoRelatorio($dados)
    {
        $model = $this->model;

        if ($dados['tp_contrato'] != ''){
            $model = $model->where('in_objeto', '=', $dados['tp_contrato']);
        }
        if ($dados['cb_vencimento'] != ''){
            $dataInicio = Carbon::now();
            $dataFim = $dataInicio->copy()->addDays($dados['cb_vencimento']);
            $model = $model->where('dt_cessacao', '>=', $dataInicio);
            $model = $model->where('dt_cessacao', '<=', $dataFim);
        }
        if ($dados['nr_contrato'] != ''){
            $model = $model->where('nr_contrato', '=', str_replace("/", "", $dados['nr_contrato']));
        }
        if ($dados['nr_processo'] != ''){
            $nr_processo = str_replace(".", "", $dados['nr_processo']);
            $nr_processo = str_replace("/", "", $nr_processo);
            $nr_processo = str_replace("-", "", $nr_processo);
            $model = $model->where('nr_processo', '=', $nr_processo);
        }
        if ($dados['cb_contratante'] != ''){
            $array_contratante = [];
            for($i = 0; $i < count($dados['cb_contratante']); $i++){
                array_push($array_contratante, $dados['cb_contratante'][$i]);
            }
            
            $model = $model->whereHas('contratante', function($query) use($array_contratante) {
                $query->whereIn('id_orgao', $array_contratante);
            });
        }
        if ($dados['cb_contratada'] != ''){
            $array_contratada = [];
            for($i = 0; $i < count($dados['cb_contratada']); $i++){
                array_push($array_contratada, $dados['cb_contratada'][$i]);
            }

            $model = $model->whereIn('id_contratada', $array_contratada);
        }
        if ($dados['cb_orgao'] != ''){
            $array_orgao = [];
            for($i = 0; $i < count($dados['cb_orgao']); $i++){
                array_push($array_orgao, $dados['cb_orgao'][$i]);
            }
            $model = $model->whereHas('itensContratacao', function($query) use($array_orgao) {
                $query->whereIn('id_orgao', $array_orgao);
            });
        }
        if ($dados['cb_edificio'] != ''){
            $array_edificio = [];
            for($i = 0; $i < count($dados['cb_edificio']); $i++){
                array_push($array_edificio, $dados['cb_edificio'][$i]);
            }
            $model = $model->whereHas('itensContratacao', function($query) use($array_edificio) {
                $query->whereIn('id_edificio', $array_edificio);
            });
        }
        if ($dados['cb_fiscal_titular'] != ''){
            $array_fiscal = [];
            for($i = 0; $i < count($dados['cb_fiscal_titular']); $i++){
                array_push($array_fiscal, $dados['cb_fiscal_titular'][$i]);
            }
            $model = $model->whereHas('fiscais', function($query) use($array_fiscal) {
                $query->whereIn('id_fiscal_titular', $array_fiscal);
            });
        }
        if ($dados['cb_fiscal_substituto'] != ''){
            $array_fiscal = [];
            for($i = 0; $i < count($dados['cb_fiscal_substituto']); $i++){
                array_push($array_fiscal, $dados['cb_fiscal_substituto'][$i]);
            }
            $model = $model->whereHas('fiscais', function($query) use($array_fiscal) {
                $query->whereIn('id_fiscal_substituto', $array_fiscal);
            });
        }
        if ($dados['dt_assinatura'] != ''){
            $model = $model->where('dt_assinatura', Carbon::createFromFormat('d/m/Y', $dados['dt_assinatura'])->format('Y-m-d'));
        }
        if ($dados['dt_publicacao'] != ''){
            $model = $model->where('dt_publicacao', Carbon::createFromFormat('d/m/Y', $dados['dt_publicacao'])->format('Y-m-d'));
        }
        if ($dados['in_status_contrato'] != ''){
            $model = $model->where('in_status_contrato', '=', $dados['in_status_contrato']);
        }
        
        return $model->get();
    }
   
}
