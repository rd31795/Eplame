<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculatorController extends Controller
{
    public function index(){
    	return view('tools.calculator.index');
    }
}
