<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cebula;

class TestController extends Controller
{
	public function index($parametr)
	{
		//return cebula::findOrFail(1)->nazwa;
		return cebula::findOrFail(1);
		// logika aplikacji 
		//return 'testowanie indexu' . $parametr;
	}
}
