<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Models\User;
use Inertia\Inertia;
use Auth;

class UsersController extends Controller
{
    /**
     * Funcion para listar los usuarios del sistema
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */

    public function index(){
        $user = User::select('id','name','operation','email','city','region', 'id_pais','phone', 'nit')->with(['roles:id,name', 'pais:id,name'])->paginate(30);

        return Inertia::render('Admin/Users', compact('user'));
    }

    /**
     * Funcion para ontener los usuarios segun un filtro 
     * 
     * @author Santiago Giraldo Pulgarín
     * @return JSON
     */
    public function fillter(Request $request){
        $filters = $request->input('filters');
        $fillRol = $filters['roles'];
        $fillPais = $filters['pais'];
        unset($filters['roles']);
        unset($filters['pais']);
        $fill = makeFillters($filters);
        $users = User::select('id','name','operation','email','city','region', 'id_pais','phone', 'nit')
        ->with('roles:id,name', 'pais:id,name')->where($fill)->whereRelation('roles','name', 'like', '%'.$fillRol.'%')
        ->whereRelation('pais','name', 'like', '%'.$fillPais.'%')->paginate(30);

        return response()->json(['status' => 1 , 'users' => $users]);
        
    }

    /**
     * Funcion para redireccíonar el usuario segun su rol 
     * 
     * @author Santiago Giraldo Pularín
     * @return Void
     */

    public function redirectUser(){
        if (Auth::user()->hasRole('admin')) {
            return redirect()->to('home');
        }else{
            return redirect()->to('aliados');
        }
    }

    /**
     * Funcion para redireccionar a la vista de creacíon de usuario
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */

    public function create(){
        $roles = Role::select('id','name')->get();

        return Inertia::render('Admin/UserCreate', compact('roles'));
    }

    /**
     * Funcion para crear un usuario
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */

    public function insert(Request $request){
        $request->validate([
            'form.name' => 'required',
            'form.email' => 'required|unique:users,email',
            'form.password' => 'required',
            'form.password_confirmation'=> 'required|same:form.password',
            'form.operation' => 'required',
            'form.city' => 'required',
            'form.region' => 'required',
            'form.pais' => 'required',
            'form.phone' => 'required|max:10|unique:users,phone',
            'form.nit' => 'required|unique:users,nit',
            'role' => 'required'
        ]);

        $data = $request->input('form');
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->operation = $data['operation'];
        $user->city = $data['city'];
        $user->region = $data['region'];
        $user->id_pais = $data['pais'];
        $user->phone = $data['phone'];
        $user->nit = $data['nit'];
        unset($data);
        if($user->save()){
            $user->assignRole($request->input('role'));
            return Redirect::route('users.index');
        }
    }

    /**
     * Funcion para redireccionar a la vista de creacíon de usuario
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */

    public function edit(Request $request){
        $roles = Role::select('id','name')->get();

        return Inertia::render('Admin/UserEdit',[ 'user' => $request->input('user'),'roles' => $roles]);
    }

    /**
     * Funcion para editar un usuario
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */

    public function update(Request $request){
        $data = $request->input('form');
        $request->validate([
            'form.id' => 'required|exists:users,id',
            'form.name' => 'required',
            'form.email' => 'required|unique:users,email,'.$data['id'],
            'form.operation' => 'required',
            'form.city' => 'required',
            'form.region' => 'required',
            'form.pais' => 'required',
            'form.phone' => 'required|max:10|unique:users,phone,'.$data['id'],
            'form.nit' => 'required|unique:users,nit,'.$data['id'],
            'role' => 'required'
        ]);

        
        $user = User::find($data['id']);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = (!empty($data['password'])) ? bcrypt($data['password']) : $user->password;
        $user->operation = $data['operation'];
        $user->city = $data['city'];
        $user->region = $data['region'];
        $user->id_pais = $data['pais'];
        $user->phone = $data['phone'];
        $user->nit = $data['nit'];
        unset($data);
        if($user->save()){
            if(!$user->hasRole($request->input('role'))){
                foreach($user->getRoleNames() as $valor){
                    $user->removeRole($valor);
                }
                $user->assignRole($request->input('role'));
            }
            return Redirect::route('users.index');
        }
    }

    /**
     * Funcion para eliminar un usuario
     * 
     * @author Santiago Giraldo Pulgarín
     * @return View
     */
    public function destroy(Request $request){
        $request->validate(['id' => 'required|exists:users,id']);
        $user = User::find($request->input('id'));
        if($user->delete()){
            return response()->json(['status' => 1 ]);
        }
    }
    
    /**
     * Funcion para el importe masivo de usuarios
     * 
     * @author Santiago Giraldo Pulgarín 
     * @return View
     */

     public function import(Request $request){
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);

        return back()->with('menssage', 'importados los usuarios');
     }
}
