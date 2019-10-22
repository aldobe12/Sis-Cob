<?php

namespace App\Http\Controllers;

use App\FechasCobro;
use App\Prestamo;
use App\User;
use DateTime;
use Illuminate\Http\Request;

class CobrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//
//    {
//        $cobros = FechasCobro::with(['Prestamo2', 'Pagos'])->orderBy('fecha','ASC')->get();
////            return $cobros;
////        foreach ($cobros as $co) {
////            if ($co->prestamo2) {
////                return $co->Prestamo2->cliente2->localidades;
////            }
////
////        }
//
//        return view('cobro.index')->with('cobros', $cobros);
//    }
    public function index($fechaDesde = null, $fechaHasta = null)

    {

        if ($fechaDesde == null AND $fechaHasta == null) {

            $fechaDesde = date('Y-m-d');
            $fechaHasta = date('Y-m-d');
        } else {
            $fechaDesde = $fechaDesde;
            $fechaHasta = $fechaHasta;
        }

        $usuarios = User::GetUsuarios();
//        $cobros = FechasCobro::whereHas('Prestamo2', function ($query) use ($usuarios) {
////            $query->whereIn('user_id' , $usuarios);
////        })->whereBetween('fecha', [$fechaDesde, $fechaHasta])
////            ->orderBy('fecha', 'ASC')
////            ->with('Pagos')
////            ->get();
  $prestamos = Prestamo::with('Fechascobro')
            ->whereIn('user_id', $usuarios)
            ->orderBy('id', 'DESC')
            ->get()->pluck('id')->toArray();
//  return $prestamos;
        $cobros = FechasCobro::whereIn('prestamo_id', $prestamos)
            ->whereBetween('fecha', [$fechaDesde, $fechaHasta])
            ->where('estadocuota_id',1)
            ->orderBy('fecha', 'ASC')
            ->with('Pagos')
            ->get();
//return $cobros;
        $deudaTotal = 0;

        foreach ($cobros as $cobro){
            if($cobro->estadocuota_id == 1){

                $deudaTotal = $deudaTotal + $cobro->valor_cuota;
            }

        }

//return $countdeuda;
//return $deudaTotal;

        return view('cobro.index')
            ->with('cobros', $cobros)
            ->with('deudaTotal', $deudaTotal)
            ->with('fechaDesde', $fechaDesde)
            ->with('fechaHasta', $fechaHasta);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
