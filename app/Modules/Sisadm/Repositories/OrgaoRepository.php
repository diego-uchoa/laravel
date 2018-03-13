<?php

namespace App\Modules\Sisadm\Repositories;

use Illuminate\Support\Facades\DB;
use App\Modules\Sisadm\Models\Orgao;
use App\Repositories\AbstractRepository;

class OrgaoRepository extends AbstractRepository
{
    private $sistemaRepository;

    public function __construct(Orgao $model, SistemaRepository $sistemaRepository)
    {
        $this->model = $model;
        $this->sistemaRepository = $sistemaRepository;
    }

    /**
    * Retorna todos os Orgãos que atendam o parametro informado
    * @param  String $orgao
    * @return Orgao
    */
    public function filterByNomeSigla($orgao)
    {
        $orgaos = DB::table('spoa_portal.vw_orgao_hierarquia')
                        ->where(DB::raw('remove_acento(upper(sg_orgao_completa))'), 'like', '%'. strtoupper($orgao) .'%')
                        ->orWhere(DB::raw('remove_acento(upper(no_orgao))'), 'like', '%'. strtoupper($orgao) .'%')
                        ->get();

        return $orgaos;
    }

    /**
    * Retorna todos os Orgãos associados ao sistema informado e ao nome/sigla do órgão informado
    * @param  String $orgao
    * @param  Integer $id_sistema
    * @return Orgao
    */
    public function filterByNomeSiglaSistema($orgao, $id_sistema)
    {
        $orgaos = DB::table('spoa_portal.vw_orgao_hierarquia')
                        ->join('spoa_portal.orgao_sistema', 'vw_orgao_hierarquia.id_orgao', '=', 'orgao_sistema.id_orgao')
                        ->select('vw_orgao_hierarquia.id_orgao','vw_orgao_hierarquia.sg_orgao_completa','vw_orgao_hierarquia.no_orgao')
                        ->where('orgao_sistema.id_sistema', '=', $id_sistema)
                        ->where(function ($query) use ($orgao) {
                            $query->where(DB::raw('remove_acento(upper(vw_orgao_hierarquia.sg_orgao_completa))'), 'like', '%'. strtoupper($orgao) .'%')
                                  ->orWhere(DB::raw('remove_acento(upper(vw_orgao_hierarquia.no_orgao))'), 'like', '%'. strtoupper($orgao) .'%');
                        })                
                        ->get();            

        return $orgaos;
    }

    /**
    * Retorna todos os Orgãos Filhos que atendam o parametro informado
    * @param  String $orgao
    * @return Orgao
    */
    public function filterOrgaosFilhosByNomeSigla($orgao)
    {
        $orgaos = DB::table('spoa_portal.vw_orgao_hierarquia')
                        ->where('sn_unidade_final', '=', 1)
                        ->where(function ($query) use ($orgao) {
                            $query->where(DB::raw('remove_acento(upper(sg_orgao_completa))'), 'like', '%'. strtoupper($orgao) .'%')
                                  ->orWhere(DB::raw('remove_acento(upper(no_orgao))'), 'like', '%'. strtoupper($orgao) .'%');
                        })                
                        ->get();

        return $orgaos;
    }

    /**
    * Retorna todos os Orgãos Filhos associados ao sistema informado e ao nome/sigla do órgão informado
    * @param  String $orgao
    * @param  Integer $id_sistema
    * @return Orgao
    */
    public function filterOrgaosFilhosByNomeSiglaSistema($orgao, $id_sistema)
    {
        $orgaos = DB::table('spoa_portal.vw_orgao_hierarquia')
                        ->join('spoa_portal.orgao_sistema', 'vw_orgao_hierarquia.id_orgao', '=', 'orgao_sistema.id_orgao')
                        ->where('vw_orgao_hierarquia.sn_unidade_final', '=', 1)
                        ->where('orgao_sistema.id_sistema', '=', $id_sistema)
                        ->where(function ($query) use ($orgao) {
                            $query->where(DB::raw('remove_acento(upper(vw_orgao_hierarquia.sg_orgao_completa))'), 'like', '%'. strtoupper($orgao) .'%')
                                  ->orWhere(DB::raw('remove_acento(upper(vw_orgao_hierarquia.no_orgao))'), 'like', '%'. strtoupper($orgao) .'%');
                        })                
                        ->get();
        return $orgaos;
    }

    /**
    * Retorna o Orgão associado ao Id informado
    * @param  Integer $id_orgao
    * @return Orgao
    */
    public function filterById($id_orgao)
    {
        $orgao = DB::table('spoa_portal.vw_orgao_hierarquia')
                        ->where('id_orgao', '=', $id_orgao)
                        ->get();
        return $orgao;
    }


    /**
    * Retorna todos os Orgãos em formato de array para popular um SELECT do tipo SELECT2
    * @param  String $no_sistema
    */
    public function prepareListaSelect2All($no_sistema = null)
    {
        $listaOrgaos = [];    
        $listaOrgaos[] = ['text' => 'SELECIONE...', 'id' => null];
        if (!isset($no_sistema)){
            $orgaos = $this->filterByNomeSigla("");
            foreach ($orgaos as $orgao) {
                $listaOrgaos[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }else{
            $sistema = $this->sistemaRepository->findByNome($no_sistema);
            $orgaos = $this->filterByNomeSiglaSistema("", $sistema->id_sistema);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }
        return $listaOrgaos;        
    }    


    /**
    * Retorna todos os Orgãos em formato de array para popular um SELECT do tipo CHOSEN
    * @param  String $no_sistema
    */
    public function prepareListaChosenAll($no_sistema = null)
    {
        $listaOrgaos = [];    
        if (!isset($no_sistema)){
            $orgaos = $this->filterByNomeSigla("");
            foreach ($orgaos as $orgao) {
                $listaOrgaos[$orgao->id_orgao] = $orgao->sg_orgao_completa ." - ". $orgao->no_orgao;
            }    
        }else{
            $sistema = $this->sistemaRepository->findByNome($no_sistema);
            $orgaos = $this->filterByNomeSiglaSistema("", $sistema->id_sistema);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[$orgao->id_orgao] = $orgao->sg_orgao_completa ." - ". $orgao->no_orgao;
            }    
        }
        return $listaOrgaos;        
    }

    /**
    * Retorna os Orgãos de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo SELECT2
    * @param  String $paramatro
    * @param  String $no_sistema
    */
    public function prepareListaSelect2BySiglaNome($parametro, $no_sistema = null)
    {
        $listaOrgaos = [];    
        $listaOrgaos[] = ['text' => 'SELECIONE...', 'id' => null];
        if (!isset($no_sistema)){
            $orgaos = $this->filterByNomeSigla($parametro);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }else{
            $sistema = $this->sistemaRepository->findByNome($no_sistema);
            $orgaos = $this->filterByNomeSiglaSistema($parametro, $sistema->id_sistema);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }
        return $listaOrgaos;        
    }    


    /**
    * Retorna os Orgãos de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo CHOSEN
    * @param  String $paramatro
    * @param  String $no_sistema
    */
    public function prepareListaChosenBySiglaNome($parametro, $no_sistema = null)
    {
        $listaOrgaos = [];
        $listaOrgaos[null] = ['SELECIONE...'];
        if (!isset($no_sistema)){
            $orgaos = $this->filterByNomeSigla($parametro);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[$orgao->id_orgao] = $orgao->sg_orgao_completa ." - ". $orgao->no_orgao;
            }    
        }else{
            $sistema = $this->sistemaRepository->findByNome($no_sistema);
            $orgaos = $this->filterByNomeSiglaSistema($parametro, $sistema->id_sistema);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[$orgao->id_orgao] = $orgao->sg_orgao_completa ." - ". $orgao->no_orgao;
            }    
        }
        return $listaOrgaos;        
    }


    /**
    * Retorna somente os Orgãos Filhos de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo SELECT2
    * @param  String $paramatro
    * @param  String $no_sistema
    * @return Array
    */
    public function prepareListaOrgaosFilhosSelect2BySiglaNome($parametro, $no_sistema = null)
    {
        $listaOrgaos = [];    
        $listaOrgaos[] = ['text' => 'SELECIONE...', 'id' => null];
        if (!isset($no_sistema)){
            $orgaos = $this->filterOrgaosFilhosByNomeSigla($parametro);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }else{
            $sistema = $this->sistemaRepository->findByNome($no_sistema);
            $orgaos = $this->filterOrgaosFilhosByNomeSiglaSistema($parametro, $sistema->id_sistema);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }
        return $listaOrgaos;  
    }

    /**
    * Retorna os Orgãos de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo CHOSEN
    * @param  String $paramatro
    * @param  String $no_sistema
    */
    public function prepareListaOrgaosFilhosChosenBySiglaNome($parametro, $no_sistema = null)
    {
        $listaOrgaos = []; 
        if (!isset($no_sistema)){
            $orgaos = $this->filterOrgaosFilhosByNomeSigla($parametro);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[$orgao->id_orgao] = $orgao->sg_orgao_completa ." - ". $orgao->no_orgao;
            }    
        }else{
            $sistema = $this->sistemaRepository->findByNome($no_sistema);
            $orgaos = $this->filterOrgaosFilhosByNomeSiglaSistema($parametro, $sistema->id_sistema);
            foreach ($orgaos as $orgao) {
                $listaOrgaos[$orgao->id_orgao] = $orgao->sg_orgao_completa ." - ". $orgao->no_orgao;
            }    
        }
        return $listaOrgaos;        
    }

    /**
    * Retorna o Orgão de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo SELECT2
    * @param  Integer $id_orgao
    * @return Array
    */
    public function prepareListaSelect2ById($id_orgao)
    {
        $retorno_formatado = [];
        $orgaos = $this->filterById($id_orgao);
        if ($orgaos)
        {
            foreach ($orgaos as $orgao) {
                $retorno_formatado[] = ['text' => $orgao->sg_orgao_completa. " - ". $orgao->no_orgao, 'id' => $orgao->id_orgao];
            }    
        }
        else
        {
            $retorno_formatado[] = ['text' => 'SELECIONE...', 'id' => null];
        }

        return $retorno_formatado;  
    }
    
    /**
    * Retorna o Orgão de acordo com o parâmetro informado em formato de array para popular um SELECT do tipo CHOSEN
    * @param  Integer $id_orgao
    * @return Array
    */
    public function prepareListaChosenById($id_orgao)
    {
        $retorno_formatado = [];
        $orgaos = $this->filterById($id_orgao);
        if ($orgaos)
        {
            foreach ($orgaos as $orgao) {
                $retorno_formatado[$orgao->id_orgao] = $orgao->sg_orgao_completa. " - ". $orgao->no_orgao;
            }    
        }
        else
        {
            $retorno_formatado[null] = 'SELECIONE...';
        }

        return $retorno_formatado;  
    }


    /**
    * Recupera o Órgão do BD pelo código UORG
    * @param  integer $co_uorg
    * @return Orgao
    */
    public function findByCodigoUorg($co_uorg)
    {
        $orgao = null;

        $co_uorg = substr(str_pad($co_uorg, 9, "0", STR_PAD_LEFT), -9);

        $orgao = $this->findBy([['co_uorg', '=' , $co_uorg]]);

        return $orgao;
    }

    /**
    * Recupera o Órgão do BD pelo código SIAFI (UASG)
    * @param  integer $co_siafi
    * @return Orgao
    */
    public function findByCodigoSiafi($co_siafi)
    {
        $orgao = null;

        $orgao = $this->findBy([['co_siafi', '=' , $co_siafi]]);
        if (count($orgao) > 0){
            $orgao['sg_uf'] = $orgao[0]->municipio->uf->sg_uf;
            return $orgao[0];
        }else{
            throw new \Exception("UASG não encontrada.", 1);
        }
    }

    /**
    * Monta orgao recuperado do WebService do SIAPE na BD
    * @param  Array $siapeDadoOrgaoWS
    * @param  Orgao $orgaoBD_Pai
    * @param  Municipio $municipio
    * @return Collection
    */
    public function montaOrgao($siapeDadoOrgaoWS, $orgaoBD_Pai, $municipio)
    {
        $modelOrgao = new Orgao();

        if ($siapeDadoOrgaoWS){

            $modelOrgao->sg_orgao = substr($siapeDadoOrgaoWS->siglaOrgao, 0, strpos($siapeDadoOrgaoWS->siglaOrgao, "/"));
            $modelOrgao->no_orgao = $siapeDadoOrgaoWS->nomeExtendido;
            $modelOrgao->id_municipio = $municipio[0]->id_municipio;
            $modelOrgao->co_uorg = str_pad($siapeDadoOrgaoWS->codUorg, 9, "0", STR_PAD_LEFT);
            $modelOrgao->sn_oficial = true;
            $modelOrgao->co_siafi = $siapeDadoOrgaoWS->codUnidadeSiafi;
            $modelOrgao->nr_ordem = 99;

            if (sizeof($orgaoBD_Pai) > 0)
            {
                $modelOrgao->id_orgao_id = $orgaoBD_Pai[0]->id_orgao;    
                $modelOrgao->nr_nivel = $orgaoBD_Pai[0]->nr_nivel + 1;
            }
                
        }

        return $modelOrgao;
    }    

    /**
    * Grava orgao recuperado do WebService do SIAPE na BD
    * @param  Orgao $orgao
    * @return Orgao
    */
    public function storeOrgaoWS($orgao, $idOrgaoPai)
    {
        if ($idOrgaoPai)
        {
            $orgao->id_orgao_id = $idOrgaoPai;
        }

        $orgao->save();
        return $orgao;

    } 
}