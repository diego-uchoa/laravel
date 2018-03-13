<?php

namespace App\Modules\Sisadm\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SisadmController extends Controller
{
	public function __construct()
	{
       	$this->middleware('auth');
	}

	public function index()
	{
		return view('sisadm::index');
	}


	public function cadastro()
	{
		return view('sisadm::cadastro');
	}

	public function relatorio()
	{
		return view('sisadm::relatorio');
	}

	public function relatorio_geral()
	{
		return view('sisadm::relatorio.relatorio_geral');		
	}

	public function relatorio_especifico()
	{
		return view('sisadm::relatorio.relatorio_especifico');
	}
}