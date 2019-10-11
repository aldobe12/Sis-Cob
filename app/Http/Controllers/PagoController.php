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

//        $success = false;
//        $this->validate($request, Pago::rules());

//        DB::beginTransaction();
        $idpre = FechasCobro::where('id', $request->idfechacobro)->first()->prestamo_id;
//        return  $idpre;
        try {
            $pago = new Pago();
            $pago->fecha_pago = now()->format('Ymd');
            $pago->capital = $request->capital;
            $pago->atraso = $request->saldo;
            $pago->nota = $request->observacion;
            $pago->forma_pago = 'Efectivo';
            $pago->created_at = now();
            $pago->fecha_cobro_id = $request->idfechacobro;
            $pago->user_id = Auth::id();
            $pago->save();
//            $campos = $request->all();

//return $request->idfechacobro;
//
            if ($request->saldo > 0) {
                $estadocuota = 3;
            } else {
                $estadocuota = 2;
            }
//            return $estadocuota;
//            $pago = Pago::create($campos);

            if ($pago) {
//                return 'Paso por si';
                $success = true;
                $fechaCob = FechasCobro::where('id', $request->idfechacobro)->first();
                $fechaCob->estadocuota_id = $estadocuota;
                $fechaCob->save();

                $prestamo = Prestamo::where('id', $fechaCob->prestamo_id)->first();
                $prestamo->monto_actual = $prestamo->monto_actual - $request->capital;
                $prestamo->updated_at = now();
                $prestamo->save();

//                $data['message'] = 'Pago registrado con exito';
//                $data['type'] = 'success';
//                route('', $prestamo->id)
                return response('Pago registrado con exito', 200);
//                return Redirect::to('/prestamos/'.$idpre)->with('response', $data);
//                return back()->with('response', $data);

//                    $request->prestamo_id)->monto_actual - $request->capital;
//                ($pago->prestamo()->update(array('monto_actual' => $monto_actual))) ? $success = true : $success = false;
            } else {
//                $data['message'] = 'Algo salió mal. Intente luego';
//                $data['type'] = 'error';
                return response('Algo salió mal. Intente luego', 404);
            }

        } catch (Exception $e) {

        }



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
