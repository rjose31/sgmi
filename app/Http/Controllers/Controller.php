<?php

namespace App\Http\Controllers;

use App\Carreras;
use App\TipoUsuario;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            return view('usuarios.usuarios');
        } else {
            return redirect()->to('/');
        }
    }

    public function indexInactivos()
    {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {

        } else {
            return redirect()->to('/');
        }
        return view('usuarios.usuarios-inactivos');
    }

    public function listaUsuariosActivos()
    {
        $data = User::where('id', '<>', auth()->user()->id)->get();
        $usuariosActivos = [];
        foreach ($data as $d)
        {
            $us = new User();
            $us->id = $d->id;
            $us->username = $d->username;
            $us->name = $d->name;
            $us->email = $d->email;
            $us->id_carrera = $d->carrera->nombre_carrera;
            $us->id_tipo_usuario = $d->tipoUsuario->tipo_usuario;
            $us->password = $d->password;
            array_push($usuariosActivos, $us);
        }
        return response()->json($usuariosActivos);
    }

    public function listaUsuariosInactivos()
    {
        $data = User::onlyTrashed()->get();
        $usuariosInactivos = [];
        foreach ($data as $d)
        {
            $us = new User();
            $us->id = $d->id;
            $us->username = $d->username;
            $us->name = $d->name;
            $us->email = $d->email;
            $us->id_carrera = $d->carrera->nombre_carrera;
            $us->id_tipo_usuario = $d->tipoUsuario->tipo_usuario;
            $us->password = $d->password;
            array_push($usuariosInactivos, $us);
        }
        return response()->json($usuariosInactivos);
    }

    public function crear()
    {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            $carreras = Carreras::all();
            $tipo_usuario = TipoUsuario::all();

            return view('auth.register', compact('carreras', 'tipo_usuario'));
        } else {
            return redirect()->to('/');
        }

    }

    public function checkUsername($username)
    {
        $u = User::where('username', '=', $username)->get();
        if(count($u) > 0) {
            return response()->json(array('success' => true), 200);
        } else {
            return response()->json(array('success' => false), 200);
        }
    }

    public function checkUsernameE($id, $username)
    {
        $u = User::where([['id', '<>', $id], ['username', '=', $username]])->get();
        if(count($u) > 0) {
            return response()->json(array('success' => true), 200);
        } else {
            return response()->json(array('success' => false), 200);
        }
    }

    public function guardar(Request $request)
    {

        $cantidad_clases = 0;

        if(User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'id_carrera' => $request->id_carrera,
                'id_tipo_usuario' => $request->id_tipo_usuario,
                'cantidad_clases' => $cantidad_clases,
                'password' => Hash::make(env('NEW_USER_DEFAULT_PASSWORD')),
            ])
        ){
            response()->json(array('success' => true), 200);
        }
    }

    public function editar($id)
    {
        if(auth()->user()->tipoUsuario->tipo_usuario == 'Administrador')
        {
            $user = User::findOrFail($id);
            $carreras = Carreras::all();
            $tipo_usuario = TipoUsuario::all();

            return view('usuarios.editar-usuario', compact('user', 'carreras', 'tipo_usuario'));
        } else {
            return redirect()->to('/');
        }

    }

    public function actualizar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_carrera = $request->carrera;
        $user->id_tipo_usuario = $request->tipo_usuario;
        if($user->save()){
            response()->json(array('success' => true), 200);
        }
    }


    public function cantidadClases(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->cantidad_clases = $request->cantidad;
        if($user->save()){
            response()->json(array('success' => true), 200);
        }
    }

    public function reiniciarPass(Request $request, $id)
    {
        $pass = $request->pass;
        $hPass = Hash::make($pass);

        $user = User::findOrFail($id);
        $user->password = $hPass;
        if($user->save()) {
            response()->json(array('success' => true), 200);
        }
    }

    public function checkCC($id)
    {
        $cant = User::where('id', '=', $id)->first()->cantidad_clases;
        return response()->json(array('cantidad' => $cant));
    }

    public function perfil()
    {
        return view('usuarios.modificar-perfil');
    }

    public function modificarPerfil(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if(strlen($request->password) > 0) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
        }

        if($user->save()) {
            response()->json(array('success' => true), 200);
        }
    }

    public function habilitarUsuario($id)
    {
        $usuario = User::where('id', '=', $id)->restore();
    }

    public function deshabilitarUsuario($id)
    {
        $usuario = User::where('id', '=', $id)->delete();
    }
}
