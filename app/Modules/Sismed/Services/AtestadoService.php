<?php
namespace App\Modules\Sismed\Services;

use App\Modules\Sismed\Http\Requests\AtestadoRequest;
use Illuminate\Http\Request;

use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\PericiaRepository;
use App\Modules\Sismed\Repositories\ControleCicloRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;
use App\Modules\Sismed\Services\CicloService;

use DB;
use Session;
use Mail;
use Exception;
use Carbon\Carbon;
use App\Http\Upload;
use App\Helpers\UtilHelper;

class AtestadoService
{
	protected $atestadoRepository;
	protected $periciaRepository;
	protected $controleCicloRepository;
	protected $servidorRepository;
    protected $cicloService;
	




	public function __construct(AtestadoRepository $atestadoRepository, 
								PericiaRepository $periciaRepository,
								ControleCicloRepository $controleCicloRepository,
								ServidorRepository $servidorRepository,
                                CicloService $cicloService)
	{
		$this->atestadoRepository = $atestadoRepository;
		$this->periciaRepository = $periciaRepository;
		$this->controleCicloRepository = $controleCicloRepository;
		$this->servidorRepository = $servidorRepository;
        $this->cicloService = $cicloService;
	}





	public function store($request)
    {
        
        try{
            DB::beginTransaction(); 

            $mode = '';

            $servidor = $this->servidorRepository->find($request['id_servidor']);
            
            if ($request->hasFile('atestado')) {

                $upload = Upload::uploadFile($request['atestado'],'storage_SISMED',$servidor->co_prontuario);
                $request['no_atestado_fisico'] = $upload['nome_arquivo'];

            }

            if ($request->hasFile('laudo')) {

                $upload = Upload::uploadFile($request['laudo'],'storage_SISMED',$servidor->co_prontuario);
                $request['no_laudo_fisico'] = $upload['nome_arquivo'];

            }
            
            $atestado = $this->atestadoRepository->create($request->all());

            $controleCiclo = $this->cicloService->criarOuRecuperarCiclo($atestado);

            $atestado->id_controle_ciclo = $controleCiclo->id_controle_ciclo;
            $atestado->save();

            $acumulado = $this->cicloService->calculaAcumulado($controleCiclo);

            if($acumulado > 120){

                $resto = $acumulado - 120;

                $prazo_pericia_1 = ($atestado->te_prazo - $resto);

                if($prazo_pericia_1 <= 0) {

                    $camposPericia = Array();

                    $camposPericia = [
                        'id_atestado' =>  $atestado->id_atestado,
                        'te_prazo' => $atestado->te_prazo,
                        'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                        'dt_fim_afastamento' => $atestado->dt_fim_afastamento,
                        'in_tipo_pericia' => 'J',
                        'in_situacao' => 'A'
                    ];

                    if($request['dt_pericia']){
                        $camposPericia ['dt_pericia'] = $request['dt_pericia'];
                    }

                    $pericia = $this->periciaRepository->create($camposPericia);


                }
                else {
                    $dt_inicio_pericia_1 = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento);
               
                    $dt_final_pericia_1 = Carbon::create($dt_inicio_pericia_1->year, $dt_inicio_pericia_1->month, $dt_inicio_pericia_1->day)->addDays(($prazo_pericia_1-1));

                    $prazo_pericia_2 = $resto;
                    
                    $dt_inicio_pericia_2 = Carbon::create($dt_final_pericia_1->year,$dt_final_pericia_1->month,$dt_final_pericia_1->day)->addDays(1);

                    $dt_final_pericia_2 = Carbon::create($dt_inicio_pericia_2->year,$dt_inicio_pericia_2->month,$dt_inicio_pericia_2->day)->addDays(($prazo_pericia_2 - 1));

                    $camposPericia1 = Array();

                    $camposPericia1 = [
                        'id_atestado' =>  $atestado->id_atestado,
                        'te_prazo' => $prazo_pericia_1,
                        'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                        'dt_fim_afastamento' => $dt_final_pericia_1->format('d/m/Y'),
                        'in_tipo_pericia' => $atestado->in_tipo_pericia,
                        'in_situacao' => 'A'
                    ];

                    if($request['dt_pericia']){
                        $camposPericia1 ['dt_pericia'] = $request['dt_pericia'];
                    }

                    $pericia_1 = $this->periciaRepository->create($camposPericia1);

                    $camposPericia2 = Array();

                    $camposPericia2 = [
                        'id_atestado' =>  $atestado->id_atestado,
                        'te_prazo' => $prazo_pericia_2,
                        'dt_inicio_afastamento' => $dt_inicio_pericia_2->format('d/m/Y'),
                        'dt_fim_afastamento' => $dt_final_pericia_2->format('d/m/Y'),
                        'in_tipo_pericia' => 'J',
                        'in_situacao' => 'A'
                    ];

                    $pericia_2 = $this->periciaRepository->create($camposPericia2);
                }

                
                Session::flash('warning', 'Servidor ultrapassou o limite de 120 dias. Perícia por Junta registrada.');
               

            }else{
                $camposPericia = Array();

                $camposPericia = [
                    'id_atestado' =>  $atestado->id_atestado,
                    'te_prazo' => $atestado->te_prazo,
                    'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                    'dt_fim_afastamento' => $atestado->dt_fim_afastamento,
                    'in_tipo_pericia' => $atestado->in_tipo_pericia,
                    'in_situacao' => 'A'
                ];

                if($request['dt_pericia']){
                    $camposPericia ['dt_pericia'] = $request['dt_pericia'];
                }

                $pericia = $this->periciaRepository->create($camposPericia);
            }

            DB::commit();

            /* Envia EMAIL*/
            if($servidor->ds_email){
                $this->_enviarEmail($servidor, $atestado);    
            }
            

            return $atestado;            

        }
        catch(Exception $e){
            DB::rollBack();
            throw new \Exception('Erro ao cadastrar atestado ('. $e->getMessage() .')');
        }
        
        
    }






    public function update($request, $id)
    {
        
        try{
            DB::beginTransaction();
            
            if($request['atestado_delete'] == 'true' && $request->hasFile('atestado') == false){
                $request['no_atestado_fisico'] = '';
            }else {
                $request['no_atestado_fisico'] = $request['atestado_atual'];
            }

            if($request['laudo_delete'] == 'true' && $request->hasFile('laudo') == false){
                $request['no_laudo_fisico'] = '';  
            }else {
                $request['no_laudo_fisico'] = $request['laudo_atual'];
            }

            
            $servidor = $this->servidorRepository->find($request['id_servidor']);          

            if ($request->hasFile('atestado')) {
                
                $upload = Upload::uploadFile($request['atestado'],'storage_SISMED',$servidor->co_prontuario);
                $request['no_atestado_fisico'] = $upload['nome_arquivo'];
            
            }

            if ($request->hasFile('laudo')) {
                
                $upload = Upload::uploadFile($request['laudo'],'storage_SISMED',$servidor->co_prontuario);
                $request['no_laudo_fisico'] = $upload['nome_arquivo'];
            
            }

            $atestado = $this->atestadoRepository->find($id); 
            $atestado->update($request->all());


            //verifica se atestado deu origem a algum ciclo
            $atestadoCicloOrigem = $this->cicloService->verificaOrigemCiclo($atestado);

            if($atestadoCicloOrigem){
                $this->cicloService->updateControleCiclo($atestado);
                $atestados = $this->buscaAtestadosCicloESubsequentes($atestado);
                $this->manterConsistenciaPericias($atestados);
            }else{
                $atestadoCiclo = $this->controleCicloRepository->find($atestado->id_controle_ciclo);
                $acumulado = $this->cicloService->calculaAcumulado($atestadoCiclo,$atestado);
                

                if($acumulado > 120){
                    $atestados = $this->buscaAtestadosCicloESubsequentes($atestado);
                    $this->manterConsistenciaPericias($atestados);
                }
                else{
                    
                    $parametros = [
                        'te_prazo' => $atestado->te_prazo,
                        'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                        'dt_fim_afastamento' => $atestado->dt_fim_afastamento,
                        'in_tipo_pericia' => 'S',
                        'in_situacao' => $atestado->in_situacao
                    ];

                    $periciasAtestado = $atestado->pericias;

                    if($periciasAtestado->isNotEmpty()){

                        $pericia = $periciasAtestado->first();
                        $this->periciaRepository->find($pericia->id_pericia)->update($parametros);

                        $periciasAtestado->shift();
                        
                        if($periciasAtestado->count() >= 1){//Se ATESTADO possui mais de uma PERICIA, essas são excluídas.

                            foreach ($periciasAtestado->all() as $periciasDelete) {
                                $this->periciaRepository->find($periciasDelete->id_pericia)->delete();
                            }
                                                            
                        }

                    }

                }

            }             

            
            DB::commit();   
            return $atestado;
            

        }
        catch(Exception $e){
            DB::rollBack();
            throw new \Exception('Erro ao atualizar atestado ('. $e->getMessage() .')');
        }


    }






    public function destroy($atestado, $justificativa)
    {   
        try{
            DB::beginTransaction();
            

            //verificar se atestado criou algum ciclo
            $atestadoCicloOrigem = $this->cicloService->verificaOrigemCiclo($atestado);

            if($atestadoCicloOrigem){
                //Delete o ciclo
                $atestados = $this->buscaAtestadosSubsequentes($atestado);
                $delete = $atestadoCicloOrigem->delete();
                                
                $this->manterConsistenciaPericias($atestados);
            }

            $atestado->tx_justificativa_exclusao = $justificativa;
            $update = $atestado->save();      
            $delete = $atestado->delete();
            

            DB::commit();
            return response(['msg' => 'Registro excluído com sucesso.', 'status' => 'success']);

        }
        catch(Exception $e){
            DB::rollBack();
            throw new \Exception('Erro ao excluir atestado ('. $e->getMessage() .')');
        }
                
    }


    


    public function atualizaSituacao($idAtestado,$pericia){
            
            $atestado = $this->atestadoRepository->find($idAtestado);

            if($pericia->in_situacao == 'A'){

                if($atestado->in_situacao == 'A'){
                    return false;
                }else{
                    $atestado->in_situacao = 'A';
                    $atestado->save();
                    return $pericia->in_situacao;   
                }

            }
            else {

                $andCriteria[] = ['id_atestado', '=', $idAtestado];
                $pericias = $this->periciaRepository->findBy($andCriteria);

                foreach ($pericias as $periciaAtestado) {
                    if($periciaAtestado->in_situacao != $pericia->in_situacao){
                        return false;
                    }
                }

                $atestado->in_situacao = $pericia->in_situacao;
                $atestado->save();
                return $pericia->in_situacao;

            }
               

    }





    public function manterConsistenciaPericias($atestados){
        foreach ($atestados as $atestadoUpdate) {
            //Veriricar sobre os updates
            $controleCiclo = $this->cicloService->criarOuRecuperarCiclo($atestadoUpdate);

            if($controleCiclo->id_controle_ciclo != $atestadoUpdate->id_controle_ciclo){
                $atestadoUpdate->id_controle_ciclo = $controleCiclo->id_controle_ciclo;
                $atestadoUpdate->save();
            }

            //somente do atestado para tras                    
            $acumulado = $this->cicloService->calculaAcumuladoEdicao($controleCiclo,$atestadoUpdate);

            //cria ou atualiza as perícias
            $pericias = $this->criarOuAtualizarPericias($acumulado,$atestadoUpdate);

            \Log::info('Atestado atualizado: '.$atestadoUpdate);

        }

    }





    public function criarOuAtualizarPericias($acumulado,$atestado){

        try{

            $periciasAtestado = $atestado->pericias;

            if($acumulado > 120){//Perícia JUNTA necessária. Cadastra (1 JUNTA) ou (1 SINGULAR e 1 JUNTA)

                $resto = $acumulado - 120;
                $prazo_pericia_1 = ($atestado->te_prazo - $resto);


                if($prazo_pericia_1 <= 0) {

                    //Cadastra (1 JUNTA)
                    $parametros = [
                        'te_prazo' => $atestado->te_prazo,
                        'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                        'dt_fim_afastamento' => $atestado->dt_fim_afastamento,
                        'in_tipo_pericia' => 'J',
                        'in_situacao' => $atestado->in_situacao
                    ];

                    if($periciasAtestado->isNotEmpty()){

                        $pericia = $periciasAtestado->first();
                        $this->periciaRepository->find($pericia->id_pericia)->update($parametros);

                        $periciasAtestado->shift();
                        
                        if($periciasAtestado->count() >= 1){ //Se ATESTADO possui mais de uma PERICIA, essas são excluídas.
                            foreach ($periciasAtestado->all() as $periciasDelete) {
                                $periciasDelete->delete();
                            }                                
                        }

                    }else{

                        $pericia = $this->periciaRepository->create($parametros);    
                    
                    } 

                }
                else {
                    //Cadastra (1 SINGULAR e 1 JUNTA)

                    $dt_inicio_pericia_1 = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento);
                    
                    $dt_final_pericia_1 = Carbon::create($dt_inicio_pericia_1->year, $dt_inicio_pericia_1->month, $dt_inicio_pericia_1->day)->addDays(($prazo_pericia_1-1));

                    $prazo_pericia_2 = $resto;
                    
                    $dt_inicio_pericia_2 = Carbon::create($dt_final_pericia_1->year,$dt_final_pericia_1->month,$dt_final_pericia_1->day)->addDays(1);

                    $dt_final_pericia_2 = Carbon::create($dt_inicio_pericia_2->year,$dt_inicio_pericia_2->month,$dt_inicio_pericia_2->day)->addDays(($prazo_pericia_2 - 1));

                    $parametros = [
                        'id_atestado' =>  $atestado->id_atestado,
                        'te_prazo' => $prazo_pericia_1,
                        'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                        'dt_fim_afastamento' => $dt_final_pericia_1->format('d/m/Y'),
                        'in_tipo_pericia' => $atestado->in_tipo_pericia,
                        'in_situacao' => $atestado->in_situacao
                    ];

                    $parametros_2 = [
                        'id_atestado' =>  $atestado->id_atestado,
                        'te_prazo' => $prazo_pericia_2,
                        'dt_inicio_afastamento' => $dt_inicio_pericia_2->format('d/m/Y'),
                        'dt_fim_afastamento' => $dt_final_pericia_2->format('d/m/Y'),
                        'in_tipo_pericia' => 'J',
                        'in_situacao' => 'A'
                    ];


                    if($periciasAtestado->isNotEmpty()){

                        if($periciasAtestado->count() == 1){

                            $pericia = $periciasAtestado->first();
                            $this->periciaRepository->find($pericia->id_pericia)->update($parametros);
                            
                            $pericia_2 = $this->periciaRepository->create($parametros_2);

                        }else{

                            $pericia = $periciasAtestado->first();
                            $this->periciaRepository->find($pericia->id_pericia)->update($parametros);

                            $pericia_2 = $periciasAtestado->last();
                            $this->periciaRepository->find($pericia_2->id_pericia)->update($parametros_2);

                        }

                    }else{
                        $pericia = $this->periciaRepository->create($parametros);

                        $pericia_2 = $this->periciaRepository->create($parametros_2);

                    }                    

                    
                }

                
                Session::flash('warning', 'Servidor ultrapassou o limite de 120 dias. Perícia por Junta registrada.');
               

            }
            else{//Somente Perícia SINGULAR necessária. Cadastra (1 SINGULAR)
                
                $parametros = [
                        'id_atestado' =>  $atestado->id_atestado,
                        'te_prazo' => $atestado->te_prazo,
                        'dt_inicio_afastamento' => $atestado->dt_inicio_afastamento,
                        'dt_fim_afastamento' => $atestado->dt_fim_afastamento,
                        'in_tipo_pericia' => 'S',
                        'in_situacao' => $atestado->in_situacao
                    ];

                if($periciasAtestado->isNotEmpty()){

                    $pericia = $periciasAtestado->first();
                    $this->periciaRepository->find($pericia->id_pericia)->update($parametros);

                    $periciasAtestado->shift();
                    
                    if($periciasAtestado->count() >= 1){//Se ATESTADO possui mais de uma PERICIA, essas são excluídas.

                        foreach ($periciasAtestado->all() as $periciasDelete) {
                            $this->periciaRepository->find($periciasDelete->id_pericia)->delete();
                        }
                                                        
                    }

                }else{
                    $pericia = $this->periciaRepository->create($parametros);    
                } 

                
            }

        }
        catch(Exception $e){
            throw new \Exception('Erro cadastrar ou atualizar perícia ('. $e->getMessage() .')');
        }

    }





    public function cancelar($atestado)
    {
        try{
            DB::beginTransaction();
            
            $atestado->in_situacao = 'X';
            $atestado->save();

            //Altera a situação das perícias
            $pericias = $atestado->pericias;

            foreach ($pericias as $periciaAtestado) {
                $periciaAtestado->in_situacao = 'X';
                $periciaAtestado->save();
            }            

            //verifica se atestado deu origem a algum ciclo
            $atestadoCicloOrigem = $this->cicloService->verificaOrigemCiclo($atestado);

            if($atestadoCicloOrigem){
                //Delete o ciclo
                $atestados = $this->buscaAtestadosSubsequentes($atestado);
                $delete = $atestadoCicloOrigem->delete();
                
                $this->manterConsistenciaPericias($atestados);
            }        

            DB::commit();
            return response(['msg' => 'Registro cancelado com sucesso.', 'status' => 'success']);

        }
        catch(Exception $e){
            DB::rollBack();
            throw new \Exception('Erro ao cancelar atestado ('. $e->getMessage() .')');
        }
                
    }





    public function buscaAtestadosCicloESubsequentes($atestado)
    {

        $dataInicioAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->toDateString();

        $andCriteria = array();
        $andCriteria[] = ['id_servidor', '=', $atestado->id_servidor];
        $andCriteria[] = ['dt_inicio_afastamento', '>=', $dataInicioAfastamento];
        
        $orCriteria = array();
        $orCriteria[] = ['id_controle_ciclo', '=', $atestado->id_controle_ciclo];
        
        $orderBy[] = ['dt_inicio_afastamento', 'ASC'];
        
        $atestados = $this->atestadoRepository->findBy($andCriteria,$orCriteria,$orderBy,null,null);

        return $atestados;
    }





    public function buscaAtestadosSubsequentes($atestado)
    {

        $dataInicioAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->toDateString();

        $andCriteria = array();
        $andCriteria[] = ['id_servidor', '=', $atestado->id_servidor];
        $andCriteria[] = ['dt_inicio_afastamento', '>=', $dataInicioAfastamento];
        $andCriteria[] = ['id_atestado', '<>', $atestado->id_atestado];
        
        $orderBy[] = ['dt_inicio_afastamento', 'ASC'];
        
        $atestados = $this->atestadoRepository->findBy($andCriteria,null,$orderBy,null,null);

        return $atestados;
    }


    public function recuperaTipoPericia($atestado)
    {
        
        $atestado = $this->atestadoRepository->find($atestado['id_atestado']);    
        
        $pericias = $atestado->pericias();

        if($pericias->count() == 1){
            return $pericias->first()->tipoPericia();
        }else{
            return 'Singular/Junta';    
        }

    }



    //_enviarEmail
    /**
    * Funcionalidade responsável por enviar email ao servidor após o cadastrado de atestado
    * 
    */
    private function _enviarEmail($servidor, $atestado)
    {
        
        Mail::send('sismed::layouts.emails.email-cadastro-atestado', 
            [
                'nome' => $servidor->no_servidor,
                'prazo' => $atestado->te_prazo,
                'dataInicio' => $atestado->dt_inicio_afastamento,
                'dataFim' => $atestado->dt_fim_afastamento,
                'crm' => $atestado->nr_crm,
            ], 
            function($message) use ($servidor){

                $message->subject('Atestado cadastrado no SISMED');
                $message->from('portal@fazenda.gov.br', 'Portal de Sistemas - SISMED');
                $message->to($servidor['ds_email']);

            });
    }



}