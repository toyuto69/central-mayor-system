<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Venta;
use App\Models\Finanza;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $totalProductos = Inventario::sum('cantidad');
        $totalVentas = Venta::sum('total');
        $ingresos = Finanza::where('tipo', 'ingreso')->sum('monto');
        $egresos = Finanza::where('tipo', 'egreso')->sum('monto');
        $balance = $ingresos - $egresos;

        $start = Carbon::now()->subDays(6);
        $ultimos7dias = [];
        $ventasPorDia = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $start->copy()->addDays($i);
            $ultimos7dias[] = $date->format('d/m');
            $ventasPorDia[] = Venta::whereDate('fecha_venta', $date)->sum('total');
        }

        $actividad = collect([
            (object)['descripcion' => 'Venta de 5 productos', 'fecha' => now()->format('H:i')],
            (object)['descripcion' => 'Ingreso de $500', 'fecha' => now()->subHour()->format('H:i')],
        ]);

        return view('home', compact(
            'totalProductos', 'totalVentas', 'ingresos', 'balance',
            'ultimos7dias', 'ventasPorDia', 'actividad'
        ));
    }
}