<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Cliente::paginate(12);
        return view('cliente.index')->with('clientes', $clients);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success = false;
        $this->validate($request, Cliente::rules());

        DB::beginTransaction();

        try {
            $campos = $request->all();
            $campos['user_id'] = Auth::id();
            $campos['avatar'] = time().'.'.$request->avatar->getClientOriginalExtension();
            
            if (Cliente::create($campos)) {
                ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
            }
        } catch (Exception $e) {

        }

        if ($success) {
            DB::commit();
            $data['message'] = 'Cliente registrado con éxito';
            $data['type'] = 'success';
            return redirect()->route('clientes.index')->with('response', $data);
        } else {
            DB::rollback();
            Cliente::deleteImage($campos['avatar'], 'avatar/');
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('clientes.index')
                            ->with('response', $data);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $success = false;
        $avatar = $cliente->avatar;
        $filename = public_path('avatars/').$cliente->avatar;
 
        DB::beginTransaction();
        try {
            $campos = $request->all();
            if ($request['avatar']) {
                $campos['avatar'] = time() . '.' . $request->avatar->getClientOriginalExtension();
                if(file_exists($filename) && $avatar != 'default-avatar.png') {
                    Filesystem::delete($filename);
                }
                if ($cliente->update($campos)) {
                    ($request->avatar->move(public_path('avatars'), $campos['avatar'])) ? $success = true : $success = false;
                }
            }else {
                ($cliente->update($campos)) ? $success = true : $success = false;
            }
        } catch (Exception $e) {

        }

        if($success) {
            DB::commit();
            $data['message'] = 'Cliente actualizado con éxito';
            $data['type'] = 'success';
            return redirect('/clientes')
                        ->with('response',$data);
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }
}
