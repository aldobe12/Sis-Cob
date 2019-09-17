<?php

namespace App\Http\Controllers;

use App\FechasCobro;
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
//        return $fechaDesde;
        if ($fechaDesde == null AND $fechaHasta == null) {

            $fechaDesde = date('Y-m-d');
            $fechaHasta = date('Y-m-d');
        } else {
            $fechaDesde = $fechaDesde;
            $fechaHasta = $fechaHasta;
        }
//return $fechaDesde;
        $cobros = FechasCobro::with(['Prestamo2', 'Pagos'])
            ->whereBetween('fecha', [$fechaDesde, $fechaHasta])
            ->orderBy('fecha', 'ASC')->get();
//        return $cobros;
//        foreach ($cobros as $co) {
//            if ($co->prestamo2) {
//                return $co->Prestamo2->cliente2->localidades;
//          ret  }
//
//        }

        return view('cobro.index')
            ->with('cobros', $cobros)
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
