<?php

namespace App\Http\Controllers\Payings;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Paying;
use Inertia\Inertia;
use Auth;

class PayingsController extends Controller
{
    /**
     * funcion para listar las liquidaciones
     * @author Santiago Giraldo
     * @return View
     */
    public function indexLiquidaciones(){
        $query = Paying::with('pais')->where('tipo', 'liquidacion');

        if(Auth::user()->hasRole(['admin','dtv_hugs'])){
            $payinds = $query->paginate(30);
            if(Auth::user()->hasRole('admin')){
                return Inertia::render('Admin/Payings', compact('payinds'));
            }
        }else{
            $query = $query->where('operation', (Auth::user()->hasRole('directv'))?'directv':'hughesnet');
        }
        $payinds = $query->where('id_pais', Auth::user()->id_pais)->paginate(30);
        return Inertia::render('Payings/index', ['payinds' => $payinds,'tipo' => 'liquidación']);
    }

    /**
     * funcion para listar las retenciones
     * @author Santiago Giraldo
     * @return View
     */
    public function indexRetenciones(){
        $query = Paying::with('pais')->where('tipo', 'retencion');

        if(Auth::user()->hasRole(['admin','dtv_hugs'])){
            $payinds = $query->paginate(30);
            if(Auth::user()->hasRole('admin')){
                return Inertia::render('Admin/Payings', compact('payinds'));
            }
        }else{
            $query = $query->where('operation', (Auth::user()->hasRole('directv'))?'directv':'hughesnet');
        }
        $payinds = $query->where('id_pais', Auth::user()->id_pais)->paginate(30);
        return Inertia::render('Payings/index', ['payinds' => $payinds,'tipo' => 'retención']);
    }

    /**
     * funcion para redirecionar a la vista de creacíon de paying
     * @author Santiago Giraldo
     * @return View
     */
    public function create(){
        return Inertia::render('Admin/PayingsCreate');
    }
    public function createL(){
        return Inertia::render('Admin/PayingsCreate');
    }

    /**
     * funcion para crear un paying
     * @author Santiago Giraldo 
     * @return View
     */
    public function insert(Request $request){
        $request->validate([
            '_link' => 'required',
            'operation' => 'required',
            'tipo' => 'required',
            'id_pais' => 'required'
        ]);

        if(Paying::create($request->all())){
            return Redirect::route($request->input('tipo').'.index');
        }
    }

    /**
     * Funcion para redireccionar a la vista de edicion de paying
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */

    public function edit(Request $request){
        return Inertia::render('Admin/PayingsEdit',['paying' => $request->input('paying')]);
    }

    /**
     * Funcion para editar un paying
     * 
     * @author Santiago Giraldo
     * @return View
     */
    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            '_link' => 'required',
            'operation' => 'required',
            'tipo' => 'required',
            'id_pais' => 'required'
        ]);

        $paying = Paying::find($request->input('id'));
        $paying->_link = $request->input('_link');
        $paying->operation = $request->input('operation');
        $paying->tipo = $request->input('tipo');
        $paying->periodo = $request->input('periodo');
        $paying->id_pais = $request->input('id_pais');

        if($paying->save()){
            return Redirect::route($request->input('tipo').'.index');
        }
    }

    /**
     * Funcion para eliminar un paying
     * 
     * @author Santiago Giraldo 
     * @return JSON
     */

    public function destroy(Request $request){
        $paying = Paying::find($request->input('id'));
        if($paying->delete()){
            return response()->json(['status' => 1 ]);
        }
    }

    public function fillter(Request $request){
        $filters = $request->input('filters');
        $fill = makeFillters($filters);
        $payings = Paying::select('id','_link', 'operation','tipo')->where($fill)
                            ->where('tipo', $request->input('tipo'))->paginate(30);

        return response()->json(['status' => 1 , 'payings' => $payings]);
    }
}
