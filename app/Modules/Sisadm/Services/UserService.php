<?php
namespace App\Modules\Sisadm\Services;

use App\Modules\Sisadm\Repositories\UserRepository;
use App\Modules\Sisadm\Repositories\OrgaoRepository;
use App\Modules\Sisadm\Repositories\SiapeDadoPessoalRepository;
use Illuminate\Http\Request;
use Mail;
use Exception;
use DB;

class UserService
{
	protected $userRepository;
	protected $orgaoRepository;
	protected $siapeWsService;
	protected $adldap;

	public function __construct(UserRepository $userRepository, 
									OrgaoRepository $orgaoRepository,
									SiapeWsService $SiapeWsService)
	{
		$this->userRepository = $userRepository;
		$this->orgaoRepository = $orgaoRepository;
		$this->siapeWsService = $SiapeWsService;
	}

	public function store($usuario)
    {
    	$usuarioBD = $this->userRepository->findByCpf($usuario['nr_cpf']);
    	if (!$usuarioBD->isEmpty()){

    		return response(['msg' => 'Usuário já cadastrado!', 'status' => 'error']);

        }else{

        	$dadosUsuarioDeleted = $this->userRepository->findDeletedByCpf($usuario['nr_cpf']);        	
        	if ($dadosUsuarioDeleted->isEmpty()){

        		$dadosUsuarioLDAP = $this->userRepository->findByCpf_LDAP($usuario['nr_cpf']);	
	        	if (!$dadosUsuarioLDAP->isEmpty()){
	        		
	        		try{
		    			
		    			DB::beginTransaction();	
		    				$dados = $usuario->all();
		    				$this->userRepository->create($dados);
		    				$this->_enviarEmail($dados, '');	

		    				//Renderizando a tabela de listagem de usuários
		    				$html = $this->renderizarTabela();
			    		DB::commit();

			    		return response(['msg' => 'Usuário cadastrado com sucesso. Um email foi enviado para '. $dados['email'] .'!', 'status' => 'success', 'html'=> $html]);
		    				
		    		}catch(\Exception $e){
		        		
		        		DB::rollBack();
		        		return response(['msg' => 'Não foi possível realizar o cadastro do usuário.', 'detail' => $e->getMessage(), 'status' => 'error']);

		        	}

		        }else{

    	        	try{

    	        		DB::beginTransaction();	
    	        			$newPassword = $this->_generatePassword(4);
    		    			$newUserBD = $this->_encryptPassword($usuario, $newPassword);
    		    			$newUserBD['sn_ldap'] = false;
    		    			
    		    			$this->userRepository->create($newUserBD);
    		    			$this->siapeWsService->findDadosPessoaisByCPF($newUserBD['nr_cpf']);	
    		    			$this->siapeWsService->findDadosFuncionaisByCPF($newUserBD['nr_cpf']);	
    		    			$this->_enviarEmail($newUserBD, $newPassword);	

    		    			//Renderizando a tabela de listagem de usuários
    		    			$html = $this->renderizarTabela();
    		    		DB::commit();

    		    		return response(['msg' => 'Usuário cadastrado com sucesso. Um email foi enviado para '. $newUserBD['email'] .'!', 'status' => 'success', 'html'=> $html]);

    	        	}catch(\Exception $e){
    	        			        		
		        		DB::rollBack();
		        		return response(['msg' => 'Não foi possível realizar o cadastro do usuário.', 'detail' => $e->getMessage(), 'status' => 'error']);

		        	}

		        }

        	}else{

    			try{
    				
    				DB::beginTransaction();	
        				if ($this->userRepository->restoreUserDeletedByCpf($usuario['nr_cpf'])){
		        			$usuarioBD = $this->userRepository->findByCpf($usuario['nr_cpf']);
		        			$newPassword = "";
		        			if (!$usuarioBD[0]->sn_ldap){
			        			$newPassword = $this->_generatePassword(4);
				    			$updateUserBD = $this->_encryptPassword($usuario, $newPassword);
		        			}
        					
        					$this->userRepository->find($usuarioBD[0]->id_usuario)->update($updateUserBD);
							$this->_enviarEmail($updateUserBD, $newPassword);	

							//Renderizando a tabela de listagem de usuários
							$html = $this->renderizarTabela();
        				}
    				DB::commit();		

    				return response(['msg' => 'Usuário reativado com sucesso. Um email foi enviado para '. $updateUserBD['email'] .'!', 'status' => 'success', 'html'=> $html]);

    			}catch(\Exception $e2){
    				
    				DB::rollBack();
    				return response(['msg' => 'Não foi possível reativar o cadastro do usuário.', 'status' => 'error']);
    			}

        	}
	        
        }

    }	

	public function update($usuario, $id)
	{
		$usuarioBD = $this->userRepository->findByCpf($usuario->nr_cpf, $id);
		if (!$usuarioBD->isEmpty() && $usuarioBD[0]['id_usuario'] != $id){

			return response(['msg' => 'CPF já cadastrado!', 'status' => 'error']);

	    }else{

			try{	
						
				DB::beginTransaction();	
					$this->userRepository->find($id)->update($usuario->all());
					$this->siapeWsService->findDadosPessoaisByCPF($usuario->nr_cpf);	
					$this->siapeWsService->findDadosFuncionaisByCPF($usuario->nr_cpf);	

					//Renderizando a tabela de listagem de usuários
					$html = $this->renderizarTabela();	

	    		DB::commit();

	    		return response(['msg' => 'Usuário alterado com sucesso.', 'status' => 'success', 'html'=> $html]);

	    	}catch(\Exception $e){
	    		
	    		DB::rollBack();
	    		return response(['msg' => 'Não foi possível realizar a alteração no cadastro do usuário.', 'detail' => $e->getMessage(), 'status' => 'error']);

	    	}		

	    }
	}

    /**
 	 * Funcionalidade responsável por atualizar a senha do usuário através da funcionalidade "Redefinir Senha"
 	 * @param 
 	 * @return \Illuminate\Http\RedirectResponse
	*/
	public function updatePassword($usuario)
	{
		try{	
					
			DB::beginTransaction();	
			
				$userBD = $this->_encryptPassword($usuario, $usuario['password']);
				$usuarioBD = $this->userRepository->findByCpf($userBD['nr_cpf']);
				$this->userRepository->find($usuarioBD[0]->id_usuario)->update($userBD);

    		DB::commit();

    		return redirect('/login')->with('message', 'Senha alterada com sucesso!');

    	}catch(\Exception $e){
    		
    		DB::rollBack();
    		return back()->with('error', ["mensagem" => "Não foi possível realizar a alteração da senha do usuário.", "erro" => $e->getMessage()]);

    	}		

	}

	/**
 	 * Gerando a senha de acesso ao portal para o usuário cadastrado
 	 * @return Request
	*/
    private function _encryptPassword(Request $request, $senha)
    {
    	$input = $request->all();
    	$input['password'] = bcrypt($senha);

        return $input;
    }

    /**
 	 * Funcionalidade responsável por gerar a senha do usuário
 	 * @return String
	*/
    private function _generatePassword($qtd)
    { 
		$Caracteres = '0123456789'; 
		$QuantidadeCaracteres = strlen($Caracteres); 
		$QuantidadeCaracteres--; 

		$Hash = NULL; 
	    
	    for ($x=1;$x<=$qtd;$x++){ 
	        $Posicao = rand(0,$QuantidadeCaracteres); 
	        $Hash .= substr($Caracteres,$Posicao,1); 
	    } 

		return "NOVA" . $Hash; 
	}

	/**
 	 * Funcionalidade responsável por enviar email ao usuário cadastrado
 	 * 
	*/
	private function _enviarEmail($user, $password)
	{
		$orgaoCollection = $this->orgaoRepository->findBy([['id_orgao', '=' , $user['id_orgao']]]);
		$orgao = $orgaoCollection[0]->sg_orgao . " - " . $orgaoCollection[0]->no_orgao;

		Mail::send('sisadm::layouts.emails.email-cadastro-usuario', 
						[
							'nome' => $user['no_usuario'],
							'cpf' => $user['nr_cpf'],
							'email' => $user['email'],
							'lotacao' => $orgao,
							'senha' => $password,
						], 
						function($message) use ($user){
            
				            $message->subject('Cadastro no Portal de Sistemas');
				            $message->from('portal@fazenda.gov.br', 'Portal de Sistemas');
				            $message->to($user['email']);

        				});
	}

	/**
	 * Método responsável por renderizar a tabela da página de listagem
	 * 
	 * @return View
	 */
	private function renderizarTabela()
	{
	    //recuperando os perfis para renderizar a tabela
	    $usuarios = $this->userRepository->findAllOrderByName();
	    return view('sisadm::usuarios._tabela', compact('usuarios'))->render(); 
	}
}