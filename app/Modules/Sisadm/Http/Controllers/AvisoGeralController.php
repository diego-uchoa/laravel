<?php

namespace App\Modules\Sisadm\Http\Controllers;

use App\Modules\Sisadm\Repositories\AvisoUsuarioRepository;
use App\Modules\Sisadm\Repositories\AvisoSistemaRepository;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Helpers\UtilHelper;

use Cache;

class AvisoGeralController extends Controller
{
    protected $avisoUsuarioRepository;
    protected $avisoSistemaRepository;


    public function __construct(AvisoUsuarioRepository $avisoUsuarioRepository, AvisoSistemaRepository $avisoSistemaRepository)
    {
        $this->avisoUsuarioRepository = $avisoUsuarioRepository;
        $this->avisoSistemaRepository = $avisoSistemaRepository;
        
    }

    public function index($sistema)
    {
        $usuario = UtilHelper::getUsername();
        
        $avisosUsuario = $this->avisoUsuarioRepository->geraAvisoUsuario($usuario,$sistema);
        $avisosUsuarioGeral = $this->avisoUsuarioRepository->geraAvisoUsuarioGeral($usuario);

        $avisosSistema = $this->avisoSistemaRepository->geraAvisoSistema($sistema);
        $avisosSistemaGeral = $this->avisoSistemaRepository->geraAvisoSistemaGeral();

        //Registra leitura de todas mensagens de usuário
        $this->avisoUsuarioRepository->marcaAvisosLidos($usuario);

        $this->atualizaAvisoUsuarioCache();

        return view('sisadm::aviso_geral.index', compact('avisosUsuario','avisosUsuarioGeral','avisosSistema','avisosSistemaGeral'));
    }

    public function indexGeral()
    {
        $usuario = UtilHelper::getUsername();
        
        $avisosUsuario = $this->avisoUsuarioRepository->geraAvisoUsuarioTodosSistemas($usuario);
        $avisosUsuarioGeral = $this->avisoUsuarioRepository->geraAvisoUsuarioGeral($usuario);

        $avisosSistema = $this->avisoSistemaRepository->geraAvisoSistemaTodosSistemas();
        $avisosSistemaGeral = $this->avisoSistemaRepository->geraAvisoSistemaGeral();

        //Registra leitura de todas mensagens de usuário
        $this->avisoUsuarioRepository->marcaAvisosLidos($usuario);

        $this->atualizaAvisoUsuarioCache();

        return view('sisadm::aviso_geral.index', compact('avisosUsuario','avisosUsuarioGeral','avisosSistema','avisosSistemaGeral'));
    }

    private function atualizaAvisoUsuarioCache()
    {
        $usuario = UtilHelper::getUsername();
        $sistema = UtilHelper::getSistema();

        $qtdAvisoNaoLido = $this->avisoUsuarioRepository->qtdAvisosNaoLidos($usuario,$sistema);
        Cache::put('qtd-avisos-usuarios-'.$sistema.'-'.$usuario, $qtdAvisoNaoLido, 60);

        $qtdAvisoNaoLidoGeral = $this->avisoUsuarioRepository->qtdAvisosNaoLidosGeral($usuario);
        Cache::put('qtd-avisos-usuarios-geral'.$usuario, $qtdAvisoNaoLidoGeral, 60);
        
    }

}