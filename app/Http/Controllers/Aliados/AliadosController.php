<?php

namespace App\Http\Controllers\Aliados;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AliadosController extends Controller
{
    /**
     * funcion para cargar la vita de inicio de los aliados 
     * @author Santiago Giraldo
     */
    public function index(){
        return Inertia::render('Welcome');
    }
}
