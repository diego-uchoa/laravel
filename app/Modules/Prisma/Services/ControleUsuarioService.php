<?php
namespace App\Modules\Prisma\Services;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;
use Exception;
use Mail;

use App\Helpers\UtilHelper;
use App\Modules\Sisadm\Repositories\UserRepository;
use App\Modules\Sisadm\Repositories\PerfilRepository;


class ControleUsuarioService
{

	protected $userRepository;
	protected $perfilRepository;
	
	public function __construct(UserRepository $userRepository, PerfilRepository $perfilRepository) {
		$this->userRepository = $userRepository;
		$this->perfilRepository = $perfilRepository;
	}

	public function associarUsuarioInstituicao($instituicao, $usuario)
	{
		$usuarioBD = $this->userRepository->findByCpf($usuario->nr_cpf);

		if (!$usuarioBD->isEmpty()){
			if($usuarioBD[0]->instituicaoPrisma){
				return response(['msg' => 'Usuário já possui Instituição associada.', 'status' => 'error']);
			}
			else {
				$instituicao->usuarios()->save($usuarioBD[0],['nr_telefone' => $usuario->nr_telefone, 'no_cargo' => $usuario->no_cargo, 'in_perfil' => $usuario->in_perfil]);
				return response(['msg' => 'Usuário associado com sucesso!', 'status' => 'success']);
			}

		} 
		else {
			return response(['msg' => 'Usuário não cadastrado!', 'status' => 'error']);
		}
	}

	public function associarPerfil($cpf,$nomePerfil)
	{
		$perfil = $this->perfilRepository->findByName($nomePerfil);
		$usuarioBD = $this->userRepository->findByCpf($cpf);
		

		if (!$usuarioBD->isEmpty()){

			$this->userRepository->syncPerfis($usuarioBD[0], $perfil->id_perfil);
			return response(['msg' => 'Perfil associado com sucesso!', 'status' => 'success']);

		} else {

			return response(['msg' => 'Usuário não cadastrado!', 'status' => 'error']);
		
		}
	}

	/**
	 * Método responsável por inserir dados solicitações de cadastro
	 *@param  Request request
	 */
	public function store($usuario)
	{
		$usuario['sn_externo'] = true;
		
		try{	

			$usuarioBD = $this->userRepository->findByCpf($usuario['nr_cpf']);

			if (!$usuarioBD->isEmpty()){

				return response(['msg' => 'Usuário já cadastrado!', 'status' => 'error']);

			}else{

				$dadosUsuarioDeleted = $this->userRepository->findDeletedByCpf($usuario['nr_cpf']); 

				if ($dadosUsuarioDeleted->isEmpty()){
					try{

						DB::beginTransaction();	
						$newPassword = $this->_generatePassword(4);
						$newUserBD = $this->_encryptPassword($usuario, $newPassword);
						$newUserBD['sn_ldap'] = false;
						

						$this->userRepository->create($newUserBD);
						$this->_enviarEmail($newUserBD, $newPassword);	

						DB::commit();

						return response(['msg' => 'Usuário cadastrado com sucesso. Um email foi enviado para '. $newUserBD['email'] .'!', 'status' => 'success']);

					}catch(\Exception $e){
						DB::rollBack();
						return response(['msg' => 'Não foi possível realizar o cadastro do usuário.', 'detail' => $e->getMessage(), 'status' => 'error']);

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
							//$html = $this->renderizarTabela();
						}
						DB::commit();		

						return response(['msg' => 'Usuário reativado com sucesso. Um email foi enviado para '. $updateUserBD['email'] .'!', 'status' => 'success', 'html'=> $html]);

					}catch(\Exception $e2){

						DB::rollBack();
						return response(['msg' => 'Não foi possível reativar o cadastro do usuário.', 'status' => 'error']);
					}

				}


			}

			return $usuarioBD;

	    }catch(Exception $e){

	    	throw new Exception($e->getMessage(), 999); 

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

				$this->userRepository->find($id)->instituicaoPrisma()->updateExistingPivot($usuario->id_instituicao, array('nr_telefone' => $usuario->nr_telefone, 'no_cargo' => $usuario->no_cargo));

	    		DB::commit();

	    		return response(['msg' => 'Usuário alterado com sucesso.', 'status' => 'success', 'html'=> '']);

	    	}catch(\Exception $e){
	    		DB::rollBack();
	    		return response(['msg' => 'Não foi possível realizar a alteração no cadastro do usuário.', 'detail' => $e->getMessage(), 'status' => 'error', 'html' => '']);

	    	}		

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

			Mail::send('prisma::layouts.emails.email-cadastro-usuario', 
				[
				'nome' => $user['no_usuario'],
				'cpf' => $user['nr_cpf'],
				'email' => $user['email'],
				'senha' => $password,
				], 
				function($message) use ($user){

					$message->subject('[PRISMA FISCAL] Dados de acesso ao sistema');
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
			$usuarios = $this->userRepository->findExternoOrderByName();
			return view('prisma::usuarios._tabela', compact('usuarios'))->render(); 
		}




}