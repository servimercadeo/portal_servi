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
            $payinds = $query->orderBy('id', 'desc')->paginate(30);
            if(Auth::user()->hasRole('admin')){
                return Inertia::render('Admin/Payings', compact('payinds'));
            }
        }else{
            $query = $query->where('operation', (Auth::user()->hasRole('directv'))?'directv':'hughesnet');
        }
        $payinds = $query->where('id_pais', Auth::user()->id_pais)->orderBy('id', 'desc')->paginate(30);
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
            $payinds = $query->orderBy('id', 'desc')->paginate(30);
            if(Auth::user()->hasRole('admin')){
                return Inertia::render('Admin/Payings', compact('payinds'));
            }
        }else{
            $query = $query->where('operation', (Auth::user()->hasRole('directv'))?'directv':'hughesnet');
        }
        $payinds = $query->where('id_pais', Auth::user()->id_pais)->orderBy('id', 'desc')->paginate(30);
        return Inertia::render('Payings/index', ['payinds' => $payinds,'tipo' => 'retención']);
    }

    /**
     * funcion para listar los churns
     * @author Santiago Giraldo
     * @return View
     */

    public function indexChurn(){
        $query = Paying::with('pais')->where('tipo', 'churn');

        if(Auth::user()->hasRole(['admin','dtv_hugs'])){
            $payinds = $query->orderBy('id', 'desc')->paginate(30);
            if(Auth::user()->hasRole('admin')){
                return Inertia::render('Admin/indexChurn', compact('payinds'));
            }
        }else{
            $query = $query->where('operation', (Auth::user()->hasRole('directv'))?'directv':'hughesnet');
        }
        $payinds = $query->where('id_pais', Auth::user()->id_pais)->orderBy('id', 'desc')->paginate(30);
        return Inertia::render('Payings/indexChurn', ['payinds' => $payinds,'tipo' => 'churn']);
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
    public function createChurn(){
        return Inertia::render('Admin/churnCreate');
    }
    /**
     * funcion para crear un paying
     * @author Santiago Giraldo
     * @return View
     */
    public function insert(Request $request){
        $request->validate([
            'doc' => 'required',
            'operation' => 'required',
            'tipo' => 'required',
            'id_pais' => 'required'
        ]);

        $file = $request->file('doc');
        $file_name = $request->input('operation').'_'.$request->input('periodo').'_'.(($request->input('id_pais') == 1)?'COL': 'ECU').'.'.$file->getClientOriginalExtension();
        $path = storage_path().'/app/files_'.$request->input('tipo').'/'.$file_name;

        if(file_exists($path)){
            return redirect()->route('churn.create')->withErrors('Ya existe un archivo con ese periodo, pon otro periodo')->withInput();
        }

        $link = config('app.global_url').$file->storeAs('files_'.$request->input('tipo'), $file_name);

        Paying::create([
            'operation' => $request->input('operation'),
            'tipo' => $request->input('tipo'),
            'id_pais' => $request->input('id_pais'),
            'periodo' => $request->input('periodo'),
            '_link' => $link,
            'file_name' => $file_name
         ]);


        return Redirect::route($request->input('tipo').'.index');
    }

    /**
     * funcion para crear un paying
     * @author Santiago Giraldo
     * @return View
     */
    public function insertChurn(Request $request){
        $request->validate([
            'doc' => 'required',
            'operation' => 'required',
            'tipo' => 'required',
            'id_pais' => 'required',
            'periodo' => 'required'
        ]);

        $file = $request->file('doc');
        $file_name = $request->input('operation').'_'.$request->input('periodo').'_'.(($request->input('id_pais') == 1)?'COL': 'ECU').'.'.$file->getClientOriginalExtension();
        $path = storage_path().'/app/files_churn/'.$file_name;

        if(file_exists($path)){
            return redirect()->route('churn.create')->withErrors('Ya existe un archivo con ese periodo, pon otro periodo')->withInput();
        }

        $link = config('app.global_url').$file->storeAs('files_churn', $file_name);

        Paying::create([
           'operation' => $request->input('operation'),
           'tipo' => $request->input('tipo'),
           'id_pais' => $request->input('id_pais'),
           'periodo' => $request->input('periodo'),
           '_link' => $link,
           'file_name' => $file_name
        ]);

        return Redirect::route('churn.index');
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

    public function editChurn(Request $request){
        return Inertia::render('Admin/churnEdit',['paying' => $request->input('paying')]);
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
            'id_pais' => 'required',
            'file_name' => 'required'
        ]);

        $file_name = $request->input('file_name');
        $link = $request->input('_link');

        if($request->file('doc') != null){
            unlink(storage_path().'/app/files_churn/'.$file_name);
            $file = $request->file('doc');
            $file_name = $request->input('operation').'_'.$request->input('periodo').'_'.(($request->input('id_pais') == 1)?'COL': 'ECU').'.'.$file->getClientOriginalExtension();
            $path = storage_path().'/app/files_'.$request->input('tipo').'/'.$file_name;

            if(file_exists($path)){
                unlink(storage_path().'/app/files_churn/'.$file_name);
            }
            $link = config('app.global_url').$file->storeAs('files_churn', $file_name);
        }

        $paying = Paying::find($request->input('id'));
        $paying->_link = $link;
        $paying->operation = $request->input('operation');
        $paying->tipo = $request->input('tipo');
        $paying->periodo = $request->input('periodo');
        $paying->id_pais = $request->input('id_pais');
        $paying->file_name = $file_name;

        if($paying->save()){
            return Redirect::route($request->input('tipo').'.index');
        }
    }

    public function updateChurn(Request $request){
        $request->validate([
            'id' => 'required',
            '_link' => 'required',
            'operation' => 'required',
            'tipo' => 'required',
            'id_pais' => 'required',
            'file_name' => 'required'
        ]);

        $file_name = $request->input('file_name');
        $link = $request->input('_link');

        if($request->file('doc') != null){
            unlink(storage_path().'/app/files_churn/'.$file_name);
            $file = $request->file('doc');
            $file_name = $request->input('operation').'_'.$request->input('periodo').'_'.(($request->input('id_pais') == 1)?'COL': 'ECU').'.'.$file->getClientOriginalExtension();
            $path = storage_path().'/app/files_churn/'.$file_name;

            if(file_exists($path)){
                unlink(storage_path().'/app/files_churn/'.$file_name);
            }
            $link = config('app.global_url').$file->storeAs('files_churn', $file_name);
        }

        $paying = Paying::find($request->input('id'));
        $paying->_link = $link;
        $paying->operation = $request->input('operation');
        $paying->tipo = $request->input('tipo');
        $paying->periodo = $request->input('periodo');
        $paying->id_pais = $request->input('id_pais');
        $paying->file_name = $file_name;

        if($paying->save()){
            return Redirect::route('churn.index');
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

        if($paying->file_name != null){
            unlink(storage_path().'/app/files_'.$request->input('tipo').'/'.$paying->file_name);
        }
        if($paying->delete()){
            return response()->json(['status' => 1 ]);
        }
    }

    public function fillter(Request $request){
        $filters = $request->input('filters');
        $fillPais = $filters['pais'];
        unset($filters['pais']);
        $tipo = $request->input('tipo');
        $fill = makeFillters($filters);
        $payings = Paying::where($fill)->with('pais:id,name')
                            ->whereRelation('pais','name', 'like', '%'.$fillPais.'%')
                            ->where('tipo', $tipo)->orderBy('id', 'desc')->paginate(30);

        return response()->json(['status' => 1 , 'payings' => $payings]);
    }

    /**
     * Funcion para descargar un documento
     *
     * @author Santiago Giraldo Pulgarín
     * @return File
     */

     public function descargar($file_name = null){
        $path = storage_path().'/app/files_churn/'.$file_name;
        if(file_exists($path)){
            return response()->download($path);
        }
     }
}
