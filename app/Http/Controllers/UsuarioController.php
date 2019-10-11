<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Organizacion;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('userAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return $role = Auth::user()->roles;
        $id_orga = User::Where('id', Auth::id())->first()->organization_id;
//        return $id_orga;
        $usuarios = User::where('organization_id', $id_orga)->get();
// return $usuarios;
        return view('usuario.index2')
            ->with('usuarios', $usuarios);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('usuario.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $success = false;
//        $this->validate($request, Usuario::rules());

        DB::beginTransaction();
        $id_orga = User::Where('id', Auth::id())->first()->organization_id;
//        dd($id_orga);

        try {
            $campos = $request->all() + ['organization_id' => $id_orga];
            $this->validate($request, [
                'name' => 'required|min:3|max:50',
                'lastname' => 'required|min:3|max:50',
                'email' => 'email',
                'vat_number' => 'max:13',
                'password' => 'required|confirmed|min:6',
            ]);
            $usu = new User();
            $usu->name = $request->name;
            $usu->lastname = $request->lastname;
            $usu->password = Hash::make($request->password);
            $usu->email = $request->email;
            $usu->created_at = now();
            $usu->organization_id =$id_orga;
$usu->save() ;
////            return $campos['password'];
//            $user = User::create([
//                'name' => $campos['name'],
//                'email' => $campos['email'],
//                'password' => Hash::make($campos['password']),
////                'organization_id' => $id_orga
//            ]);
//            return $user;
//            $campos['organization_id'] = $id_orga;
//            $campos['avatar'] = time().'.'.$request->avatar->getUsuarioOriginalExtension();
//            ($usu = User::create($campos)) ? $success = true : $success = false;
//            return $usu;
//            if (User::create($campos)) {
////                ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
//            }
        } catch (Exception $e) {

        }

        if ($usu) {
            DB::commit();
            $role = new RoleUser();
            $role->role_id = 2;
            $role->user_id = $usu->id;
            $role->created_at = now();
            $role->save();
//return $role;
            $data['message'] = 'Usuario registrado con éxito';
            $data['type'] = 'success';

            $id_orga = User::Where('id', Auth::id())->first()->organization_id;
//        return $id_orga;
            $usuarios = User::where('organization_id', $id_orga)->get();
            return view('usuario.index2')
                ->with('usuarios', $usuarios);
//            return redirect()->route('usuarios.index2')->with('response', $data);
        } else {
            DB::rollback();
//            User::deleteImage($campos['avatar'], 'avatar/');
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('usuarios.index')
                ->with('response', $data);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return view('usuario.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        return view('usuario.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $success = false;
        $avatar = $cliente->avatar;
        $filename = public_path('avatars/') . $usuario->avatar;

        DB::beginTransaction();
        try {
            $campos = $request->all();
            if ($request['avatar']) {
                $campos['avatar'] = time() . '.' . $request->avatar->getUsuarioOriginalExtension();
                if (file_exists($filename) && $avatar != 'default-avatar.png') {
                    Filesystem::delete($filename);
                }
                if ($usuario->update($campos)) {
                    ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
                }
            } else {
                ($usuario->update($campos)) ? $success = true : $success = false;
            }
        } catch (Exception $e) {

        }

        if ($success) {
            DB::commit();
            $data['message'] = 'Usuario actualizado con éxito';
            $data['type'] = 'success';
            return redirect('/usuarios')
                ->with('response', $data);
        } else {
            DB::rollback();
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('usuarios.index')
                ->with('response', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
    }
}
