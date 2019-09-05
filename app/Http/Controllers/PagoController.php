<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::paginate();

        return view('pago.index')->with('pagos', $pagos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($prestamo)
    {
        $data['prestamo'] = Prestamo::findOrFail($prestamo)->id;
        $data['num'] = Pago::where('prestamo_id', $prestamo)->get()->count();
        return view('pago.create')->with('data', $data);
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
        $this->validate($request, Pago::rules());

        DB::beginTransaction();

        try {
            $campos = $request->all();
            $monto_actual = Prestamo::findOrFail($request->prestamo_id)->monto_actual - $request->capital;
            $pago = Pago::create($campos);
            if ($pago) {
                ($pago->prestamo()->update(array('monto_actual' => $monto_actual))) ? $success = true : $success = false;
            }
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
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();
        $data['message'] = 'Pago cancelado';
            $data['type'] = 'success';
            return redirect()->route('prestamos.index')
                            ->with('response', $data);
    }
}
