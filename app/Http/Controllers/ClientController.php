<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Organizacion;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Redirect;
use Schema;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $id = Auth::user()->id;
        $usuarios = User::GetUsuarios();

        $clients = Cliente::with('localidades')
            ->whereIn('user_id', $usuarios)
            ->get();
//return $clients;
        return view('cliente.index2')
            ->with('clientes', $clients);
    }

    public function index2()
    {

        $clients = Cliente::paginate(12);
        return view('cliente.index2')->with('clientes', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
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
//        $this->validate($request, Cliente::rules());

//        DB::beginTransaction();

        try {
            $cliente = new Cliente();
            $campos = $request->all();
            $cliente->nombre = $request->get('nombre');
            $cliente->apellido = $request->get('apellido');
            $cliente->sexo = $request->get('sexo');
            $cliente->dni = $request->get('dni');
            $cliente->fechaN = $request->get('fechaN');
            $cliente->telefono = $request->get('telefono');
            $cliente->localidad = $request->get('localidad');
            $cliente->direccion = $request->get('direccion');
            $cliente->estadocivil = $request->get('estadocivil');
            $cliente->email = $request->get('email');
            $cliente->user_id = Auth::id();
            $cliente->created_at = now();

            $cliente->save();
//            return $cliente;
//            dd($campos);
//            $campos['user_id'] = Auth::id();
//            $campos['created_at'] = now();
//            $campos['avatar'] = time().'.'.$request->avatar->getClientOriginalExtension();
//            dd($campos);
//            if (Cliente::create($campos)) {
////                ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
//            }
        } catch (Exception $e) {

        }

//        if ($success) {
////            return
//            DB::commit();
        $data['message'] = 'Cliente registrado con éxito';
        $data['type'] = 'success';

        return Redirect::to('/cliente/list')->with('response', $data);
//            return redirect('')
//        } else {
//            DB::rollback();
////            Cliente::deleteImage($campos['avatar'], 'avatar/');
//            $data['message'] = 'Algo salió mal. Intente luego';
//            $data['type'] = 'error';
//            return redirect()->route('clientes.index')
//                            ->with('response', $data);
//        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show2')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
//        return $cliente;
        return view('cliente.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $success = false;
        $avatar = $cliente->avatar;
        $filename = public_path('avatars/') . $cliente->avatar;

        DB::beginTransaction();
        try {
            $campos = $request->all();
            if ($request['avatar']) {
                $campos['avatar'] = time() . '.' . $request->avatar->getClientOriginalExtension();
                if (file_exists($filename) && $avatar != 'default-avatar.png') {
                    Filesystem::delete($filename);
                }
                if ($cliente->update($campos)) {
                    ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
                }
            } else {
                ($cliente->update($campos)) ? $success = true : $success = false;
            }
        } catch (Exception $e) {

        }

        if ($success) {
            DB::commit();
            $data['message'] = 'Cliente actualizado con éxito';
            $data['type'] = 'success';
            return redirect('/clientes')
                ->with('response', $data);
        } else {
            DB::rollback();
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('clientes.index')
                ->with('response', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }
}
