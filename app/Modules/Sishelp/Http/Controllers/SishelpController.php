<?php

namespace App\Modules\Sishelp\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SishelpController extends Controller
{
	public function __construct()
	{
       	$this->middleware('auth');
	}

	public function index()
	{

		return view('sishelp::index');
	}

}