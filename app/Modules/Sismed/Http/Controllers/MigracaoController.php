<?php

namespace App\Modules\Sismed\Http\Controllers;

use Log;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MaskHelper;
use DB;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Modules\Sismed\Services\AtestadoService;
use App\Modules\Sismed\Repositories\ServidorRepository;
use App\Modules\Sismed\Repositories\AtestadoRepository;
use App\Modules\Sismed\Repositories\ControleProntuarioRepository;

use App\Modules\Sisadm\Services\SiapeWsService;
use App\Modules\Sisadm\Repositories\SiapeCargoRepository;


class MigracaoController extends Controller
{

    protected $atestadoService;
    protected $atestadoRepository;
    protected $servidorRepository;
    protected $controleProntuarioRepository;

    protected $siapeWsService;
    protected $siapeCargoRepository;

	public function __construct(
	    AtestadoService $atestadoService,
        AtestadoRepository $atestadoRepository,
	    ServidorRepository $servidorRepository,
        ControleProntuarioRepository $controleProntuarioRepository,
        SiapeWsService $SiapeWsService,
        SiapeCargoRepository $siapeCargoRepository)
	{
	    $this->atestadoService = $atestadoService;
        $this->atestadoRepository = $atestadoRepository;
	    $this->servidorRepository = $servidorRepository;
        $this->controleProntuarioRepository = $controleProntuarioRepository;

        $this->siapeWsService = $SiapeWsService;
        $this->siapeCargoRepository = $siapeCargoRepository;
	 }


    public function importar()
    {
    	return view('sismed::migracao.importar');
    }

    public function verificaCadastrados(Request $request){

        $atestadoCadastrado = new Collection;
        $servidorNaoEncontrado = new Collection;
        $atestadoServidorNaoEncontrado = new Collection;
        $atestadoNaoCadastrado = new Collection;
        $atestadoCadastrado = new Collection;

        if($request->hasFile('import_file')){

            $linhas = $request['numero_linhas'];
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->limitRows($linhas)->get();

            //dd($data->toArray());
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $key => $value) {

                   if(!empty($value)){

                        $dataInicio = $value['dt_inicio_afastamento'];
                        //Recuperar o id do servidor
                       $andCriteria = Array();
                        $andCriteria[] = ['nr_cpf', '=', MaskHelper::removeMascaraCpf($value['nr_cpf'])];
                        $servidor = $this->servidorRepository->findBy($andCriteria);


                        //SERVIDOR/PRONTUARIO CADASTRADO
                        if($servidor->isNotEmpty()){

                            $value['id_servidor'] = $servidor->first()->id_servidor;

                            //verifica se ja existe atestado
                            $andCriteria = Array();
                            $andCriteria[] = ['id_servidor', '=', $value['id_servidor']];
                            $andCriteria[] = ['dt_inicio_afastamento', '=', $dataInicio->copy()->format('Y-m-d')];
                            
                            $cadastrado = $this->atestadoRepository->findBy($andCriteria);



                            if($cadastrado->isNotEmpty()){
                                $cadastrado = $cadastrado->first();
                                $atestadoCadastrado->push([
                                    'PLA_nr_cpf' => $value['nr_cpf'],
                                    'PLA_dt_inicio_afastamento' => $value['dt_inicio_afastamento'],
                                    'PLA_in_tipo_pericia' => $value['in_tipo_pericia'], 
                                    'PLA_in_situacao' => $value['in_situacao'],
                                    'BD_id_servidor' => $cadastrado->id_servidor,
                                    'BD_dt_inicio_afastamento' => $cadastrado->dt_inicio_afastamento,
                                    'BD_in_tipo_pericia' => $cadastrado->in_tipo_pericia, 
                                    'BD_in_situacao' => $cadastrado->in_situacao

                                    ]);
                            }
                            else{

                                $atestadoNaoCadastrado->push([
                                    'PLA_nr_cpf' => $value['nr_cpf'],
                                    'PLA_dt_inicio_afastamento' => $value['dt_inicio_afastamento'],
                                    'PLA_in_tipo_pericia' => $value['in_tipo_pericia'], 
                                    'PLA_in_situacao' => $value['in_situacao'],
                                    ]);

                            }


                        }
                        //SERVIDOR NÃO ENCONTRADO    
                        else{
                            /*Adicionar o prontuario do servidor*/
                            $servidorNaoEncontrado->push(['nr_cpf' => $value['nr_cpf'], 'no_servidor' => $value['no_servidor']]);
                            $atestadoServidorNaoEncontrado->push(['nr_cpf' => $value['nr_cpf'],'dt_inicio_afastamento' => $value['dt_inicio_afastamento']]);
                        }




                    }//fim if $value

                }//fim foreach

            }//fim if(!em



        }else{
            return back()->with('error','Please Check your file, Something is wrong there.');
        }
        //dd('verificaCadastrados');

        $result = [
            'atestadoCadastrado' => $atestadoCadastrado,
            'servidorNaoEncontrado' => $servidorNaoEncontrado,
            'atestadoServidorNaoEncontrado' => $atestadoServidorNaoEncontrado,
            'atestadoNaoCadastrado' => $atestadoNaoCadastrado
        ];

        return $result;
    }

    public function importExcel(Request $request)
    {
        //dd($request);
        if($request['verificaCadastro']){
            
            $result = $this->verificaCadastrados($request);

            $atestadoCadastrado = $result['atestadoCadastrado'];
            $servidorNaoEncontrado = $result['servidorNaoEncontrado'];
            $atestadoServidorNaoEncontrado = $result['atestadoServidorNaoEncontrado'];
            $atestadoNaoCadastrado = $result['atestadoNaoCadastrado'];
            
            return view('sismed::migracao.resultado_verifica', 
                compact(
                    'atestadoCadastrado',
                    'servidorNaoEncontrado',
                    'atestadoServidorNaoEncontrado',
                    'atestadoNaoCadastrado'))->with('message', 'Resultado');
            exit();
        }

        $servidorNaoEncontrado = new Collection;
        $atestadoCadastradoNovoServidor = new Collection;
        $atestadoDuplicado = new Collection;
        $atestadoCadastrado = new Collection;

    	try {
    		DB::beginTransaction();


    		if($request->hasFile('import_file')){
    			$linhas = $request['numero_linhas'];
    			$path = $request->file('import_file')->getRealPath();

    			$data = Excel::load($path, function($reader) {})->limitRows($linhas)->get();

    			//dd($data->toArray());
    			if(!empty($data) && $data->count()){

    				foreach ($data->toArray() as $key => $value) {
    					
    					
    					if(!empty($value)){


                            //Prazo para calcular o fim do afastamento
                            $prazo = (int) $value['te_prazo'] - 1 ;

                            //Datas
                            $dataInicio = $value['dt_inicio_afastamento'];
                            $dataFim = ($dataInicio->copy()->addDays($prazo));
                            $dataRegistro = $value['created_at'];

                            //converter as datas da planilha
                            $value['dt_inicio_afastamento'] = $dataInicio->copy()->format('d/m/Y');
                            $value['dt_fim_afastamento'] = $dataFim->copy()->format('d/m/Y');
                            $value['created_at'] = $dataRegistro->format('Y-m-d');


                            //Convertendo data Pericia
                            if(!empty($value['dt_pericia'])){
                                $dataPericia = $value['dt_pericia'];
                                $value['dt_pericia'] = $dataPericia->copy()->format('d/m/Y');
                           }
                            

    						//Recuperar o id do servidor, se não encontrar criar novo servidor/prontuario
                           $andCriteria = Array();
    						$andCriteria[] = ['nr_cpf', '=', MaskHelper::removeMascaraCpf($value['nr_cpf'])];
    						$servidor = $this->servidorRepository->findBy($andCriteria);


    						if($servidor->isNotEmpty()){//SERVIDOR/PRONTUARIO CADASTRADO

                            
    							//incluir o id no array value
    							$value['id_servidor'] = $servidor->first()->id_servidor;


                                //**Verifica se existe e Cria o Atestado

                                    //verifica se ja existe atestado
                                    $andCriteria = Array();
                                    $andCriteria[] = ['id_servidor', '=', $value['id_servidor']];
                                    $andCriteria[] = ['dt_inicio_afastamento', '=', $dataInicio->copy()->format('Y-m-d')];
                                    $andCriteria[] = ['dt_fim_afastamento', '=', $dataFim->copy()->format('Y-m-d')];
                                    $andCriteria[] = ['in_tipo_pericia', '=', $value['in_tipo_pericia']];
                                    $andCriteria[] = ['in_situacao', '=', $value['in_situacao']];
                                    $andCriteria[] = ['in_area_atendimento', '=', $value['in_area_atendimento']];
                                    $andCriteria[] = ['in_tipo_afastamento', '=', $value['in_tipo_afastamento']];
                                    $cadastrado = $this->atestadoRepository->findBy($andCriteria);


                                    if($cadastrado->isNotEmpty()){
                                        $atestadoDuplicado->push(['nr_cpf' => $value['nr_cpf'],'dt_inicio_afastamento' => $value['dt_inicio_afastamento'],'in_tipo_pericia' => $value['in_tipo_pericia'], 'in_situacao' => $value['in_situacao']]);
                                    }
                                    else{

                                        //Paramentros em Request
                                        $request = new \Illuminate\Http\Request();
                                        $request->replace($value);

                                        
                                        //Cadastra Atestado
                                        $atestado = $this->atestadoService->store($request);
                                        $atestado->created_at = $dataRegistro;
                                        $atestado->save();
                                        

                                        $atestadoCadastrado->push(['nr_cpf' => $value['nr_cpf'],'dt_inicio_afastamento' => $value['dt_inicio_afastamento'],'in_tipo_pericia' => $value['in_tipo_pericia'], 'in_situacao' => $value['in_situacao']]);

                                    }

                                //** Fim Verifica se existe e Cria o Atestado




    								
    						} 





    						else{//SERVIDOR/PRONTUARIO NÃO CADASTRADO

                                //**Monta parametros servidor

                                    $servidorArray = Array();
                                    $servidorArray ['no_servidor'] = $value['no_servidor'];
                                    $servidorArray ['nr_cpf'] = $value['nr_cpf'];
                                    $servidorArray ['in_regime_juridico'] = 'EST';
                                    $servidorArray ['in_situacao_servidor'] = $value['regime'];


                                    /*
                                    $wsDadosPessoais = $this->siapeWsService->findDadosPessoaisByCPF($value['nr_cpf']);

                                    if($wsDadosPessoais){
                                        $servidorArray ['in_sexo'] = $wsDadosPessoais['in_sexo'];
                                        $data = new Carbon($wsDadosPessoais['dt_nascimento']);
                                        $servidorArray ['dt_nascimento'] = $data->format('d/m/Y');
                                    }
                                    */

                                    /*$wsDadosFuncionais = $this->siapeWsService->findDadosFuncionaisByCPF($value['nr_cpf']);

                                    if(!empty($wsDadosFuncionais)){
                                        foreach ($wsDadosFuncionais as $wsdf) {

                                            if($wsdf['ds_ocorrencia_exclusao'] == ''){
                                                $servidorArray ['nr_siape'] = $wsdf['nr_siape'];

                                                $cargo = $this->siapeCargoRepository->find($wsdf['co_cargo']);
                                                $servidorArray ['no_cargo'] = $cargo->no_cargo;
                                            }
                                            
                                        }
                                    }*/

                                //**Fim Monta paramentros

                                
                                //**Cadastra Servidor/Atualiza Controle Prontuário

                                    //Código Prontuário
                                    $letraNomeServidor = substr($value['no_servidor'],0,1); 
                                    $ultimoNumeroProntuario = $this->controleProntuarioRepository->findByLetraProntuario($letraNomeServidor);       
                                    
                                    $servidorArray['co_prontuario'] = $ultimoNumeroProntuario->nr_prontuario.$letraNomeServidor;
                                    
                                    
                                    //Cria novo Servidor
                                    $novoServidor = $this->servidorRepository->create($servidorArray);

                                    //Atualiza Código Prontuário
                                    $ultimoNumeroProntuario->nr_prontuario = $ultimoNumeroProntuario->nr_prontuario +1;
                                    $ultimoNumeroProntuario->save();


                                //**Fim Cadastra Servidor
                                
                                
                                //incluir o id no array value
                                $value['id_servidor'] = $novoServidor->id_servidor;


                                //**Verifica se existe e Cria o Atestado

                                    //verifica se ja existe atestado
                                    $andCriteria = Array();
                                    $andCriteria[] = ['id_servidor', '=', $value['id_servidor']];
                                    $andCriteria[] = ['dt_inicio_afastamento', '=', $dataInicio->copy()->format('Y-m-d')];
                                    $andCriteria[] = ['dt_fim_afastamento', '=', $dataFim->copy()->format('Y-m-d')];
                                    $andCriteria[] = ['in_tipo_pericia', '=', $value['in_tipo_pericia']];
                                    $andCriteria[] = ['in_situacao', '=', $value['in_situacao']];
                                    $andCriteria[] = ['in_area_atendimento', '=', $value['in_area_atendimento']];
                                    $andCriteria[] = ['in_tipo_afastamento', '=', $value['in_tipo_afastamento']];
                                    $cadastrado = $this->atestadoRepository->findBy($andCriteria);


                                    if($cadastrado->isNotEmpty()){
                                        $atestadoDuplicado->push(['nr_cpf' => $value['nr_cpf'],'dt_inicio_afastamento' => $value['dt_inicio_afastamento'],'in_tipo_pericia' => $value['in_tipo_pericia'], 'in_situacao' => $value['in_situacao']]);
                                    }
                                    else{

                                        //Paramentros em Request
                                        $request = new \Illuminate\Http\Request();
                                        $request->replace($value);

                                        //Cadastra Atestado
                                        $atestado = $this->atestadoService->store($request);
                                        $atestado->created_at = $dataRegistro;
                                        $atestado->save();

                                        $atestadoCadastrado->push(['nr_cpf' => $value['nr_cpf'],'dt_inicio_afastamento' => $value['dt_inicio_afastamento'],'in_tipo_pericia' => $value['in_tipo_pericia'], 'in_situacao' => $value['in_situacao']]);

                                    }

                                //** Fim Verifica se existe e Cria o Atestado    
                      

                                /*Adicionar o prontuario do servidor*/
                                $servidorNaoEncontrado->push(['CPF' => $value['nr_cpf'], 'nome_servidor' => $value['no_servidor'], 'regime' => $value['regime'], 'prontuario' => $novoServidor->co_prontuario]);
                                $atestadoCadastradoNovoServidor->push(['nr_cpf' => $value['nr_cpf'],'dt_inicio_afastamento' => $value['dt_inicio_afastamento'],'in_tipo_pericia' => $value['in_tipo_pericia'], 'in_situacao' => $value['in_situacao']]);
    						}
    						
    					

    					}
    		
    				}

    			}

    		}
            
            $qtd_servidorNaoEncontrado = $servidorNaoEncontrado->count();
            $qtd_atestadoCadastradoNovoServidor = $atestadoCadastradoNovoServidor->count();
            $qtd_atestadoDuplicado = $atestadoDuplicado->count();
            $qtd_atestadoCadastrado = $atestadoCadastrado->count();

            $atestadoCadastradoConcluido = $atestadoCadastrado->where('in_situacao','C')->count();
            $atestadoCadastradoApericiar = $atestadoCadastrado->where('in_situacao','A')->count();
            $atestadoCadastradoCancelado = $atestadoCadastrado->where('in_situacao','X')->count();


            $result = [
                'servidorNaoEncontrado' => json_encode($servidorNaoEncontrado),
                'atestadoCadastradoNovoServidor' => json_encode($atestadoCadastradoNovoServidor),
                'atestadoDuplicado' => json_encode($atestadoDuplicado),
                'atestadoCadastrado' => json_encode($atestadoCadastrado)
            ];

            Log::info('Importação Sismed');
            Log::info($result);


    		DB::commit();
            return view('sismed::migracao.resultado', 
                compact(
                    'qtd_servidorNaoEncontrado',
                    'qtd_atestadoCadastradoNovoServidor',
                    'qtd_atestadoDuplicado',
                    'qtd_atestadoCadastrado',
                    'atestadoCadastradoConcluido',
                    'atestadoCadastradoApericiar',
                    'atestadoCadastradoCancelado'))->with('message', 'Dados migrados com sucesso.');
    	} 
    	catch(Exception $e){
            DB::rollBack();
            throw new \Exception('Erro na migração dos dados ('. $e->getMessage() .')');
        }

    	

    	return back()->with('error','Please Check your file, Something is wrong there.');
    }

}
