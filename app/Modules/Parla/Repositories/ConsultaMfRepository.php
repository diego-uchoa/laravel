<?php

namespace App\Modules\Parla\Repositories;

use App\Modules\Parla\Models\ConsultaMf;
use App\Repositories\AbstractRepository;
use Carbon\Carbon;
use DB;

class ConsultaMfRepository extends AbstractRepository
{
    public function __construct(ConsultaMf $model)
    {
        $this->model = $model;
    }

    public function preparaDadosRelatorioTipo1($params) 
    {
    	$dados = array();

        $consultas = ConsultaMf::with('proposicao.ultima_tramitacao')->get();

        if(isset($params['dt_inicio']) and ($params['dt_inicio'] != '')) {
            $consultas = $consultas->filter(function ($consulta) use($params) {
                return Carbon::createFromFormat('d/m/Y', $consulta['dt_envio'])->toDateString() >= Carbon::createFromFormat('d/m/Y', $params['dt_inicio'])->toDateString();
            });
        }

        if(isset($params['dt_fim']) and ($params['dt_fim'] != '')) {
            $consultas = $consultas->filter(function ($consulta) use($params) {
                return Carbon::createFromFormat('d/m/Y', $consulta['dt_envio'])->toDateString() <= Carbon::createFromFormat('d/m/Y', $params['dt_fim'])->toDateString();
            });
        }

        if(isset($params['sg_casa_tramitacao']) and ($params['sg_casa_tramitacao'] != '')) {
            $consultas = $consultas->where('proposicao.ultima_tramitacao.sg_casa_tramitacao',$params['sg_casa_tramitacao']);
        }

        $dados['MF'] = [
            'C' => $consultas->where('status','C')->count(),
            'P' => $consultas->where('status','P')->count(),
            'A' => $consultas->where('status','A')->count(),
        ];

    	$orgaosConsultados = $this->getOrgaosConsultados();

        foreach ($orgaosConsultados as $orgao) {
            if($orgao->sg_orgao != 'MF') {
                if($consultas->where('id_orgao', $orgao->id_orgao)->count() != 0) {
                    $dados[$orgao->sg_orgao] = [
                        'C' => $consultas->where('status','C')->where('id_orgao', $orgao->id_orgao)->count(),
                        'P' => $consultas->where('status','P')->where('id_orgao', $orgao->id_orgao)->count(),
                        'A' => $consultas->where('status','A')->where('id_orgao', $orgao->id_orgao)->count(),
                    ];
                }
            }
        }   

    	return $dados;
    }

    public function preparaDadosRelatorioTipo2($params) 
    {
        $dados = array();

        $consultas = ConsultaMf::with('proposicao.ultima_tramitacao')->orderBy('dt_envio')->get();

        if(isset($params['dt_inicio']) and ($params['dt_inicio'] != '')) {
            $consultas = $consultas->filter(function ($consulta) use($params) {
                return Carbon::createFromFormat('d/m/Y', $consulta['dt_envio'])->toDateString() >= Carbon::createFromFormat('d/m/Y', $params['dt_inicio'])->toDateString();
            });
        }

        if(isset($params['dt_fim']) and ($params['dt_fim'] != '')) {
            $consultas = $consultas->filter(function ($consulta) use($params) {
                return Carbon::createFromFormat('d/m/Y', $consulta['dt_envio'])->toDateString() <= Carbon::createFromFormat('d/m/Y', $params['dt_fim'])->toDateString();
            });
        }

        if(isset($params['sg_casa_tramitacao']) and ($params['sg_casa_tramitacao'] != '')) {
            $consultas = $consultas->where('proposicao.ultima_tramitacao.sg_casa_tramitacao',$params['sg_casa_tramitacao']);
        }

        $dados['MF'] = [
            'C' => $consultas->where('status','C'),
            'P' => $consultas->where('status','P'),
            'A' => $consultas->where('status','A'),
        ];

        $orgaosConsultados = $this->getOrgaosConsultados();

        foreach ($orgaosConsultados as $orgao) {
            if($orgao->sg_orgao != 'MF') {
                if($consultas->where('id_orgao', $orgao->id_orgao)->count() != 0) {
                    $dados[$orgao->sg_orgao] = [
                        'C' => $consultas->where('status','C')->where('id_orgao', $orgao->id_orgao),
                        'P' => $consultas->where('status','P')->where('id_orgao', $orgao->id_orgao),
                        'A' => $consultas->where('status','A')->where('id_orgao', $orgao->id_orgao),
                    ];
                }
            }
        }   

        return $dados;
    }

    public function preparaDadosRelatorioTipo3($params) 
    {
        $dados = array();

        $consultas = ConsultaMf::with('proposicao.ultima_tramitacao')->get();

        if(isset($params['dt_inicio']) and ($params['dt_inicio'] != '')) {
            $consultas = $consultas->filter(function ($consulta) use($params) {
                return Carbon::createFromFormat('d/m/Y', $consulta['dt_envio'])->toDateString() >= Carbon::createFromFormat('d/m/Y', $params['dt_inicio'])->toDateString();
            });
        }

        if(isset($params['dt_fim']) and ($params['dt_fim'] != '')) {
            $consultas = $consultas->filter(function ($consulta) use($params) {
                return Carbon::createFromFormat('d/m/Y', $consulta['dt_envio'])->toDateString() <= Carbon::createFromFormat('d/m/Y', $params['dt_fim'])->toDateString();
            });
        }

        if(isset($params['sg_casa_tramitacao']) and ($params['sg_casa_tramitacao'] != '')) {
            $consultas = $consultas->where('proposicao.ultima_tramitacao.sg_casa_tramitacao',$params['sg_casa_tramitacao']);
        }

        $consultas = $consultas->sortBy('proposicao.an_ano_origem')->sortBy('proposicao.nr_numero_origem')->sortBy('proposicao.sg_sigla_origem')->groupBy('id_proposicao');


        foreach ($consultas as $id_proposicao => $consultasProposicao) {
            $consultasProposicao = $consultasProposicao->unique('id_orgao');

            $proposicao = $consultasProposicao->where('id_proposicao',$id_proposicao)->first()->proposicao;

            $dados[$id_proposicao] = [
                'Id' => $id_proposicao,
                'Proposição' => $proposicao->sn_possui_revisora ? $proposicao->origem.' - '.$proposicao->revisora : $proposicao->origem,
                'Ementa' => $proposicao->tx_ementa,
                'Órgãos' => rtrim($consultasProposicao->reduce(function ($carry, $item) {
                                return $carry .= $item->orgao->sg_orgao.', ';
                            }),', ')
            ];
        }

        return $dados;
    }

    public function getOrgaosConsultados() 
    {
        return ConsultaMf::join('spoa_portal.orgao','orgao.id_orgao','consulta_mf.id_orgao')
            ->select('orgao.id_orgao','orgao.sg_orgao')
            ->groupBy('orgao.sg_orgao','orgao.id_orgao')
            ->get();
    }
}
