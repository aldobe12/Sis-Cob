<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Role;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::paginate(12);

        return view('usuario.index2')
            ->with('usuarios', $usuarios)
            ;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = false;
//        $this->validate($request, Usuario::rules());

        DB::beginTransaction();

        try {
            $campos = $request->all();
            return $campos;
            $campos['user_id'] = Auth::id();
//            $campos['avatar'] = time().'.'.$request->avatar->getUsuarioOriginalExtension();
            
            if (User::create($campos)) {
                ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
            }
        } catch (Exception $e) {

        }

        if ($success) {
            DB::commit();
            $data['message'] = 'Usuario registrado con éxito';
            $data['type'] = 'success';
            return redirect()->route('usuarios.index2')->with('response', $data);
        } else {
            DB::rollback();
            User::deleteImage($campos['avatar'], 'avatar/');
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('usuarios.index')
                            ->with('response', $data);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return view('usuario.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        return view('usuario.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $success = false;
        $avatar = $cliente->avatar;
        $filename = public_path('avatars/').$usuario->avatar;
 
        DB::beginTransaction();
        try {
            $campos = $request->all();
            if ($request['avatar']) {
                $campos['avatar'] = time() . '.' . $request->avatar->getUsuarioOriginalExtension();
                if(file_exists($filename) && $avatar != 'default-avatar.png') {
                    Filesystem::delete($filename);
                }
                if ($usuario->update($campos)) {
                    ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
                }
            }else {
                ($usuario->update($campos)) ? $success = true : $success = false;
            }
        } catch (Exception $e) {

        }

        if($success) {
            DB::commit();
            $data['message'] = 'Usuario actualizado con éxito';
            $data['type'] = 'success';
            return redirect('/usuarios')
                        ->with('response',$data);
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
    }
}
