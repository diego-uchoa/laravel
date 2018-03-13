<?php
namespace App\Modules\Prisma\Services;

use Illuminate\Support\Collection;
use App\Helpers\UtilHelper;
use DB;
use Exception;

use App\Modules\Prisma\Repositories\InstituicaoRepository;


class InstituicaoService
{

	protected $instituicaoRepository;
	
	public function __construct(InstituicaoRepository $instituicaoRepository) {
		$this->instituicaoRepository = $instituicaoRepository;
	}


	/**
	 * Método responsável por inserir dados solicitações de cadastro
	 *@param  Request request
	 */
	public function store($request)
	{
		try{	

			$instituicao = $this->instituicaoRepository->create($request);

			return $instituicao;

	    }catch(Exception $e){

	    	throw new Exception($e->getMessage(), 999); 

	    }

	}


}