<?php

namespace App\Http\Controllers;

use App\FechasCobro;
use App\Pago;
use App\Cliente;
use App\Prestamo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index()
    {
        $fechaDesde = date('Y-m-d');
        $fechaHasta = date('Y-m-d');
        $usuarios = User::GetUsuarios();
        $cobros = FechasCobro::whereHas('Prestamo2', function ($query) use ($usuarios) {
            $query->whereIn('user_id' , $usuarios);
        })->whereBetween('fecha', [$fechaDesde, $fechaHasta])
            ->orderBy('fecha', 'ASC')
            ->with('Pagos')
            ->get();
$fecha = now()->format('d/m/Y');
//        return $usuarios;
//        ->whereIn('user_id', $usuarios)
        $dashboard = (object) [
            'clientes' => Cliente::whereIn('user_id',$usuarios)->count(),
            'prestamos' => Prestamo::whereIn('user_id',$usuarios)->count(),
            'totalPrestado' => Prestamo::whereIn('user_id',$usuarios)->sum('monto'),
            'totalInteres' => Pago::whereIn('user_id',$usuarios)->sum('capital'),
            'cuentasCobrar' => $cobros,
            'fecha' => $fecha,

//            'totalInteres' =>0,
        ];
//       return $dashboard->cuentasCobrar;

        return view('dashboard')->with('dashboard', $dashboard);
    }
}
