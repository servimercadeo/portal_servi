<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Inertia\Inertia;

class PermisosController extends Controller
{
    /**
     * funcion para listar los permisos 
     * @author Santiago Giraldo
     * @return View
     */
    public function index(){
        $permisos = Permission::select('id','name')->get();

        return Inertia::render('Seguridad/Permisos', compact('permisos'));
    }
}
