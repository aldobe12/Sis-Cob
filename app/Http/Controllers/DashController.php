<?php

namespace App\Http\Controllers;

use App\Pago;
use App\Cliente;
use App\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashController extends Controller
{
    public function index()
    {
        $dashboard = (object) [
            'clientes' => Cliente::where('user_id', Auth::id())->count(),
            'prestamos' => Prestamo::count(),
            'totalPrestado' => Prestamo::sum('monto'),
            'totalInteres' => Pago::sum('interes'),
        ];

        return view('dashboard')->with('dashboard', $dashboard);
    }
}
