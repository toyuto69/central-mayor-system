<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Venta;
use App\Models\Finanza;

class ResumenController extends Controller
{
    public function index()
    {
        $totalProductos = Inventario::sum('cantidad');
        $totalVentas = Venta::sum('total');
        $ingresos = Finanza::where('tipo', 'ingreso')->sum('monto');
        $egresos = Finanza::where('tipo', 'egreso')->sum('monto');
        $balance = $ingresos - $egresos;

        $ultimasVentas = Venta::with('inventario')->latest()->take(5)->get();
        $ultimosMovimientos = Finanza::latest()->take(5)->get();

        return view('resumen.index', compact(
            'totalProductos', 'totalVentas', 'balance',
            'ultimasVentas', 'ultimosMovimientos'
        ));
    }
}