<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Sisadm\Repositories\SistemaRepository;
use App\Modules\Sisadm\Repositories\AvisoSistemaRepository;
use App\Modules\Sisadm\Repositories\AvisoUsuarioRepository;
use App\Modules\Sisadm\Repositories\OperacaoFavoritaRepository;
use App\Modules\Sisadm\Repositories\FeriadoRepository;
use App\Modules\Sisadm\Repositories\EventoRepository;
use App\Modules\Sisadm\Repositories\UserRepository;

use App\Modules\Sisadm\Models\Sistema;
use App\Modules\Sisadm\Models\Evento;
use App\Modules\Sisadm\Models\Feriado;

use App\Helpers\UtilHelper;
use Cache;
use URL;
use DateTime;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{

    protected $sistemaRepository;
    protected $avisoSistemaRepository;
    protected $avisoUsuarioRepository;
    protected $operacaoFavoritaRepository;
    protected $feriadoRepository;
    protected $eventoRepository;
    protected $usuarioRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SistemaRepository $sistemaRepository,AvisoSistemaRepository $avisoSistemaRepository, AvisoUsuarioRepository $avisoUsuarioRepository,OperacaoFavoritaRepository $operacaoFavoritaRepository,FeriadoRepository $feriadoRepository,EventoRepository $eventoRepository,UserRepository $usuarioRepository)
    {
        $this->sistemaRepository = $sistemaRepository;
        $this->avisoSistemaRepository = $avisoSistemaRepository;
        $this->avisoUsuarioRepository = $avisoUsuarioRepository;
        $this->operacaoFavoritaRepository = $operacaoFavoritaRepository;
        $this->feriadoRepository = $feriadoRepository;
        $this->eventoRepository = $eventoRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()) {

            $usuario = UtilHelper::getUsername();

            $sistemas = $this->sistemaRepository->geraMenuSistema($usuario);

            //CACHE- SISTEMA
            if(!Cache::has('menu-sistemas-'.$usuario)) {
                Cache::add('menu-sistemas-'.$usuario,$sistemas,60);   
            }

            //CACHE - AVISO SISTEMA GERAL
            if(!Cache::has('menu-avisos-sistemas-geral')) {
                $avisoSistema = $this->avisoSistemaRepository->geraAvisoSistemaDestaqueGeral();
                Cache::add('menu-avisos-sistemas-geral', $avisoSistema, 60);
            }

            if(!Cache::has('qtd-avisos-sistemas-geral')) {
                $qtdAvisoSistema = $this->avisoSistemaRepository->qtdAvisoSistemaDestaqueGeral();    
                Cache::add('qtd-avisos-sistemas-geral', $qtdAvisoSistema, 60);
            }

            //CACHE - AVISO USUARIO GERAL
            if(!Cache::has('menu-avisos-sistemas-geral-'.$usuario)) {
                $avisoUsuario = $this->avisoUsuarioRepository->geraAvisoUsuarioGeral($usuario);
                Cache::add('menu-avisos-usuarios-geral-'.$usuario, $avisoUsuario, 60);
            }

            if(!Cache::has('qtd-avisos-usuarios-geral-'.$usuario)) {
                $qtdAvisoUsuario = $this->avisoUsuarioRepository->qtdAvisosNaoLidosGeral($usuario);   
                Cache::add('qtd-avisos-usuarios-geral-'.$usuario, $qtdAvisoUsuario, 60);
            }

            $favoritos = $this->treeView($usuario,$sistemas);
            $calendario = $this->calendario();

            return view('home',['sistemas'=>$sistemas, 'tree' => $favoritos, 'calendario' => $calendario]);

        }
        else {
            return view('auth.login');
        }
    }

    public function calendario() {

        $usuarios = $this->usuarioRepository->getListaAniversariosAno();
        $eventosAniversarios = [];
        if (count($usuarios) > 0) {
            foreach ($usuarios as $usuario) {
                $data_aniversario = explode('/', $usuario->dt_nascimento);
                $eventosAniversarios[] = \Calendar::event(
                 $usuario->no_usuario,
                 true,
                 Carbon::createFromDate($data_aniversario[2], $data_aniversario[1], $data_aniversario[0]),
                 Carbon::createFromDate($data_aniversario[2], $data_aniversario[1], $data_aniversario[0]),
                 $usuario->id_usuario
                 );
            }
        }

        $feriados = $this->feriadoRepository->getListaFeriadosAno();
        $eventosFeriados = [];
        if (count($feriados) > 0) {
            foreach ($feriados as $feriado) {
                $eventosFeriados[] = \Calendar::event(
                    $feriado->no_feriado,
                    true,
                    Carbon::createFromFormat('d/m/Y', $feriado->dt_feriado)->format('Y-m-d'),
                    Carbon::createFromFormat('d/m/Y', $feriado->dt_feriado)->format('Y-m-d'),
                    $feriado->id_feriado
                );
            }
        }

        $eventos = $this->eventoRepository->getListaEventosAno();
        $eventosGerais = [];
        if (count($eventos) > 0) {
            foreach ($eventos as $evento) {
                $eventosGerais[] = \Calendar::event(
                    $evento->no_evento,
                    true,
                    new DateTime($evento->dt_inicio),
                    new DateTime($evento->dt_fim),
                    $evento->id_evento
                );
            }
        }

        $calendario = \Calendar::addEvents($eventosFeriados, [ 
                    'color' => '#F89406',   //orange
                    'tipo' => 'feriado',
                    'route' => URL::route('portal.home.calendario', 'feriado'),
                ]) //Feriados
            ->addEvents($eventosAniversarios, [
                    'color' => '#82AF6F',   //green
                    'tipo' => 'aniversario',
                    'route' => URL::route('portal.home.calendario', 'aniversario'),
                ]) //Eventos
            ->addEvents($eventosGerais, [
                    'color' => '#3A87AD', //blue
                    'tipo' => 'evento',
                    'route' => URL::route('portal.home.calendario', 'evento'),
                ]) //Eventos
            ->setOptions([
                    'locale' => 'pt-br',
                    'header' => [
                        'left' => 'prev,next today novoButton',
                        'center' => 'title',
                        'right' => 'month,agendaWeek,agendaDay'
                    ], 
                    'navLinks' => 'true'
                ])
            ->setCallbacks([
                    'eventClick' => 'function(event){
                        $.fn.carregarDadosCalendario(event);
                    }'
                ]); 

        return $calendario;
    }

    /**
     * Método resonsável por recuperar dados do Evento por meio do ID
     *
     * @return Evento
     */
    public function findDadosCalendarioById($tipo, $id)
    {   
        switch ($tipo) {
            case 'aniversario':
            $dadosAniversario = $this->usuarioRepository->find($id);
                //dd($dadosAniversario->orgao->no_orgao);
                //$dadosAniversario['no_orgao'] = $dadosAniversario->orgao;
            $html = view('_modal_Aniversario', compact('dadosAniversario'))->render(); 
            return response(['msg' => '', 'status' => 'success', 'html'=> $html]);        
            case 'feriado':
            $dadosFeriado = $this->feriadoRepository->find($id);
            $html = view('_modal_Feriado', compact('dadosFeriado'))->render(); 
            return response(['msg' => '', 'status' => 'success', 'html'=> $html]);        
            case 'evento':
            $dadosEvento = $this->eventoRepository->find($id);
            $html = view('_modal_Evento', compact('dadosEvento'))->render(); 
            return response(['msg' => '', 'status' => 'success', 'html'=> $html]);        
        }
    }


    public function treeView($usuario,$sistemas){

        $qtdFavoritos = $this->operacaoFavoritaRepository->contaMenuFavorito($usuario);

        if ($qtdFavoritos == 0) {
            return '<h6>Não existem operações favoritas cadastradas</h6>';
        }

        $tree='<ul id="favoritos" class="filetree">';
        
        foreach ($sistemas as $sistema) {
            $nomeSistema = $sistema->no_sistema;
            $imagemSistema = URL::to('/').'/icones/icone_'.$nomeSistema.'.png';
            $idSistema = $sistema->id_sistema;
            $operacoesFavoritas = $this->operacaoFavoritaRepository->geraMenuFavorito($usuario,$idSistema);

            if(count($operacoesFavoritas)) {
                $tree .='<li class="tree-view closed"><a class="tree-name"><img src="'.$imagemSistema.'" width="20" height="20" alt="'.$nomeSistema.'"/> '.$nomeSistema.'</a>'; 
                $tree .=$this->childView($operacoesFavoritas);
            } 
        }
        
        $tree .='<ul>';            
        return $tree;            
    }

    public function childView($operacoesFavoritas){                 
        $html ='<ul>';
        foreach ($operacoesFavoritas as $operacaoFavorita) {

            $nome = $operacaoFavorita->no_operacao;
            $descricaoOperacao = $operacaoFavorita->ds_operacao;

            $rota = URL::route($nome);

            $html .='<li class="tree-view closed"><i class="fa fa-chevron-right"></i><a href="'.$rota.'" class="tree-name"> '.$descricaoOperacao.'</a>';
            $html .="</li>";                                                   
        }

        $html .="</ul>";
        return $html;
    }    

}
