<?php

namespace App\Modules\Sisfone\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SisfoneController extends Controller
{
	public function index()
	{
		return view('sisfone::index');
	}
}