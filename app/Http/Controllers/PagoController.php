<?php

namespace App\Http\Controllers;

use App\FechasCobro;
use App\Pago;
use App\Prestamo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fechaDesde = null, $fechaHasta = null)

    {

        if ($fechaDesde == null AND $fechaHasta == null) {

            $fechaDesde = date('Ymd');
            $fechaHasta = date('Ymd');
        } else {
////            $fechaDesde = $fechaDesde;
//            $fechaHasta = $fechaHasta;
            $fechaDesde = Carbon::parse($fechaDesde)->format('Ymd');
            $fechaHasta = Carbon::parse($fechaHasta)->format('Ymd');
        }

        $usuarios = User::GetUsuarios();
        $pagos = Pago::whereIn('user_id', $usuarios)
            ->whereBetween('fecha_pago', [$fechaDesde, $fechaHasta])
            ->orderBy('fecha_pago', 'ASC')
            ->with('FechaCobro')
            ->get();
//return $pagos;


        $pagoTotal = 0;
        foreach ($pagos as $pago) {

            $pagoTotal = $pagoTotal + $pago->capital;


        }
//return  $pagoTotal;


        return view('pago.index')
            ->with('pagos', $pagos)
            ->with('pagoTotal', $pagoTotal)
            ->with('fechaDesde', $fechaDesde)
            ->with('fechaHasta', $fechaHasta);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{

    $idpre = FechasCobro::where('id', $request->get('idfechacobro'))->first()->prestamo_id;
    try {
        $pago = new Pago();
        $pago->fecha_pago = now()->format('Ymd');
        $pago->capital = $request->capital;
        $pago->atraso = $request->saldo;
        $pago->nota = $request->observacion;
        $pago->forma_pago = 'Efectivo';
        $pago->created_at = now();
        $pago->fecha_cobro_id = $request->get('idfechacobro');
        $pago->user_id = Auth::id();
        $pago->save();

        if ($request->saldo > 0) {
            $estadocuota = 3;
        } else {
            $estadocuota = 2;
        }


        $fechaCob = FechasCobro::where('id', $request->get('idfechacobro'))->first();
        $fechaCob->estadocuota_id = $estadocuota;
        $fechaCob->save();

        $prestamo = Prestamo::where('id', $fechaCob->prestamo_id)->first();
        $prestamo->monto_actual = $prestamo->monto_actual - $request->capital;
        $prestamo->updated_at = now();
        $prestamo->save();

        $path = '/prestamos/'.$idpre;
        $data['message'] = 'Pago registrado con éxito';
        $data['type'] = 'success';

        return Redirect::to($path)->with('response', $data);
    }
    catch (Exception $e) {
        $path = '/prestamos/'.$idpre;
        $data['message'] = 'Error intento luego';
        $data['type'] = 'error';

        return Redirect::to($path)->with('response', $data);
    }

//        return response('Pago creado con éxito', 200);


}

    /**
     * Display the specified resource.
     *
     * @param \App\Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Pago $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Pago $pago
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
