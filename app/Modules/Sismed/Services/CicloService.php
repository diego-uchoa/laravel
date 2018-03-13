<?php
namespace App\Modules\Sismed\Services;

use App\Modules\Sismed\Http\Requests\AtestadoRequest;
use Illuminate\Http\Request;

use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\PericiaRepository;
use App\Modules\Sismed\Repositories\ControleCicloRepository;
use App\Modules\Sismed\Repositories\ServidorRepository;

use Session;
use Mail;
use Exception;
use Carbon\Carbon;
use App\Http\Upload;

class CicloService
{
	protected $atestadoRepository;
	protected $periciaRepository;
	protected $controleCicloRepository;
	protected $servidorRepository;
	

	public function __construct(AtestadoRepository $atestadoRepository, 
								PericiaRepository $periciaRepository,
								ControleCicloRepository $controleCicloRepository,
								ServidorRepository $servidorRepository)
	{
		$this->atestadoRepository = $atestadoRepository;
		$this->periciaRepository = $periciaRepository;
		$this->controleCicloRepository = $controleCicloRepository;
		$this->servidorRepository = $servidorRepository;
	}


    public function manterConsistenciaCiclos($ciclosServidor){

        if($ciclosServidor->count() > 1){
            foreach ($ciclosServidor->last()->atestados as $atestado) {
                $atestado->id_controle_ciclo = $ciclosServidor->first()->id_controle_ciclo;
                $atestado->save(); 
            }
            $this->controleCicloRepository->find($ciclosServidor->last()->id_controle_ciclo)->delete();
        }
        return $ciclosServidor->first();
    }

	public function criarOuRecuperarCiclo($atestado)
    {
        try{

            $dataInicioAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento);
            $dataFimAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_fim_afastamento);

            $ciclosPorServidor = $this->controleCicloRepository->filterByIdServidorData($atestado->id_servidor,$dataInicioAfastamento->copy()->toDateString());

            //Mantem somente um ciclo para o periodo.
            $cicloServidor = $this->manterConsistenciaCiclos($ciclosPorServidor);


            if($cicloServidor){
                        
                $dataInicioCiclo = Carbon::parse($cicloServidor->dt_inicio_ciclo); 
                $dataFimCiclo = Carbon::parse($cicloServidor->dt_fim_ciclo);

                //Verifica se data_fim_afastamento é maior que a data_fim_ciclo
                if($dataFimAfastamento->copy()->toDateString() > $dataFimCiclo->copy()->toDateString()){

                    //Verifica se já existe ciclo posterior criado
                    /*$cicloPosteriorServidor = $this->controleCicloRepository->filterByIdServidorData($atestado->id_servidor,$dataFimAfastamento->copy()->toDateString());

                    if($cicloPosteriorServidor){

                        throw new \Exception('Não é possível registrar novo ciclo. Ciclo para o período já cadastrado.');
                    
                    }*/
                    //else{
                        $diferenca = $dataFimAfastamento->copy()->diffInDays($dataFimCiclo->copy());

                        $controleCicloCreate = $this->controleCicloRepository->create([
                            'id_servidor' => $atestado->id_servidor,
                            'dt_inicio_ciclo' => $dataFimCiclo->copy()->addDays(1)->toDateString(),
                            'dt_fim_ciclo' => $dataFimCiclo->copy()->addYear()->toDateString(),
                            'id_atestado_origem' => $atestado->id_atestado,
                            'va_adicional_ciclo_anterior' => $diferenca
                            ]);

                        Session::flash('info', 'Atestado ultrapassou a Data Fim do Ciclo do servidor. Novo ciclo registrado.');

                        return $cicloServidor;    
                    //}

                }else{

                    return $cicloServidor;

                }


            }else{
                      
                $controleCiclo = $this->createControleCiclo($atestado);
                return $controleCiclo;
                
            }

        }catch(Exception $e){
            throw new \Exception('Erro ao criar ou recuperar Controle Ciclo ('. $e->getMessage() .')');
        }

        
    
    
    }

    public function createControleCiclo($atestado){
        $controleCicloCreate = $this->controleCicloRepository->create([
                    'id_servidor' => $atestado->id_servidor,
                    'dt_inicio_ciclo' => Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->toDateString(),
                    'dt_fim_ciclo' => Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->addYear()->subDay()->toDateString(),
                    'id_atestado_origem' => $atestado->id_atestado
                ]);

        return $controleCicloCreate;
    }

    public function updateControleCiclo($atestado){
        $controleCicloUpdate = $this->controleCicloRepository->find($atestado->id_controle_ciclo)->update([
                    'dt_inicio_ciclo' => Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->toDateString(),
                    'dt_fim_ciclo' => Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->addYear()->subDay()->toDateString(),
                    'id_atestado_origem' => $atestado->id_atestado
                ]);

        return $controleCicloUpdate;
    }

    


    public function calculaAcumulado($controleCiclo){
            
            $andCriteria[] = ['id_servidor', '=', $controleCiclo->id_servidor];
            $andCriteria[] = ['dt_inicio_afastamento', '>=', $controleCiclo->dt_inicio_ciclo];
            $andCriteria[] = ['dt_inicio_afastamento', '<=', $controleCiclo->dt_fim_ciclo];
            $andCriteria[] = ['in_tipo_afastamento', '<>', 'A'];
            $andCriteria[] = ['in_situacao', '<>', 'X'];

            $atestados = $this->atestadoRepository->findBy($andCriteria);

            if($controleCiclo->va_adicional_ciclo_anterior){
                return $atestados->sum('te_prazo') + $controleCiclo->va_adicional_ciclo_anterior;
            }else{
                return $atestados->sum('te_prazo');    
            }

    }

    public function calculaAcumuladoEdicao($controleCiclo,$atestado){

            $dataInicioAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->toDateString();
            
            $andCriteria[] = ['id_servidor', '=', $controleCiclo->id_servidor];
            $andCriteria[] = ['dt_inicio_afastamento', '>=', $controleCiclo->dt_inicio_ciclo];
            $andCriteria[] = ['dt_inicio_afastamento', '<=', $dataInicioAfastamento];
            $andCriteria[] = ['in_tipo_afastamento', '<>', 'A'];
            $andCriteria[] = ['in_situacao', '<>', 'X'];

            $atestados = $this->atestadoRepository->findBy($andCriteria);

            if($controleCiclo->va_adicional_ciclo_anterior){
                return $atestados->sum('te_prazo') + $controleCiclo->va_adicional_ciclo_anterior;
            }else{
                return $atestados->sum('te_prazo');    
            }

    }


    public function verificaOrigemCiclo($atestado){

        return $this->controleCicloRepository->filterByAtestadoOrigem($atestado->id_atestado);
            
    }

    public function destroy($controleCiclo){

        try{
            return $controleCiclo->delete();
        }catch(Exception $e){
            throw new \Exception('Erro ao excluir ciclo ('. $e->getMessage() .')');
        }
    
    }


    









    /* 25-09-15:15
        public function criarOuRecuperarCiclo($atestado)
        {
            try{

                $cicloServidor = $this->controleCicloRepository->filterByIdServidor($atestado->id_servidor);


                if($cicloServidor){
                            
                    if(Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento)->toDateString() > $cicloServidor->dt_fim_ciclo){
                        
                        $controleCiclo = $this->createControleCiclo($atestado);
                        return $controleCiclo;

                    }else{                            
                            $dataInicioAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_inicio_afastamento);
                            $dataFimAfastamento = Carbon::createFromFormat('d/m/Y', $atestado->dt_fim_afastamento);

                            $dataInicioCiclo = Carbon::parse($cicloServidor->dt_inicio_ciclo); 
                            $dataFimCiclo = Carbon::parse($cicloServidor->dt_fim_ciclo);

                            //Verifica $atestado->data_inicio_afastamento está entre o $acumulado->data_inicio_acumulado e $acumulado->data_fim_acumulado
                            if( $dataInicioAfastamento->copy()->toDateString() >= $dataInicioCiclo->copy()->toDateString() && 
                                $dataInicioAfastamento->copy()->toDateString() <= $dataFimCiclo->copy()->toDateString() ){


                                //Verifica se data_fim_afastamento é maior que a data_fim_ciclo
                                if($dataFimAfastamento->copy()->toDateString() > $dataFimCiclo->copy()->toDateString()){

                                    $diferenca = $dataFimAfastamento->copy()->diffInDays($dataFimCiclo->copy());

                                    $controleCicloCreate = $this->controleCicloRepository->create([
                                        'id_servidor' => $atestado->id_servidor,
                                        'dt_inicio_ciclo' => $dataFimCiclo->copy()->addDays(1)->toDateString(),
                                        'dt_fim_ciclo' => $dataFimCiclo->copy()->addYear()->toDateString(),
                                        'id_atestado_origem' => $atestado->id_atestado,
                                        'va_adicional_ciclo_anterior' => $diferenca
                                    ]);

                                    return $cicloServidor; 


                                }else{

                                    return $cicloServidor;

                                }
                            
                            }else{
                                
                                throw new \Exception('Não é possível registrar atestado. Atestado com data de inicio de afastamento anterior cadastrado.'); 
                            
                            }


                    }

                }else{
                          
                    $controleCiclo = $this->createControleCiclo($atestado);
                    return $controleCiclo;
                    
                }

            }catch(Exception $e){
                throw new \Exception('Erro ao cadastrar controle ciclo ('. $e->getMessage() .')');
            }

            
        
        
        }
    */



}