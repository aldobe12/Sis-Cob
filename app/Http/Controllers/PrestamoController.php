<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamo::paginate();

        return view('prestamo.index')->with('prestamos', $prestamos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::selectRaw('id, CONCAT(nombre," ",apellido) as full_name')->pluck('full_name', 'id');
        return view('prestamo.create')->with('clientes', $clientes);
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
        $this->validate($request, Prestamo::rules());

        DB::beginTransaction();

        try {
            $campos = $request->all();
            $campos['monto_actual'] = $request->monto;
            (Prestamo::create($campos)) ? $success = true : $success = false;
        } catch (Exception $e) {

        }

        if ($success) {
            DB::commit();
            $data['message'] = 'Prestamo creado con éxito';
            $data['type'] = 'success';
            return redirect()->route('prestamos.index')->with('response', $data);
        } else {
            DB::rollback();
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('prestamos.index')
                            ->with('response', $data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {
        return view('prestamo.show')->with('prestamo', $prestamo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        return view('prestamo.edit')->with('prestamo', $prestamo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $success = false;
        $cliente = $prestamo->cliente_id;
 
        DB::beginTransaction();
        try {
            $campos = $request->all();
            $campos['cliente_id'] = $cliente;
            ($prestamo->update($campos)) ? $success = true : $success = false;
        } catch (Exception $e) {

        }

        if($success) {
            DB::commit();
            $data['message'] = 'Prestamo actualizado con éxito';
            $data['type'] = 'success';
            return redirect('prestamos.index')
                        ->with('response',$data);
        } else {
            DB::rollback();
            $data['message'] = 'Algo salió mal. Intente luego';
            $data['type'] = 'error';
            return redirect()->route('prestamos.index')
                            ->with('response', $data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        $data['message'] = 'Prestamo cancelado';
            $data['type'] = 'success';
            return redirect()->route('prestamos.index')
                            ->with('response', $data);
    }
}
