<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Inventario;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('inventario')->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:inventarios,id',
            'cantidad_vendida' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0.01',
            'fecha_venta' => 'required|date',
        ]);

        $inventario = Inventario::find($request->producto_id);
        if ($inventario->cantidad < $request->cantidad_vendida) {
            return back()->withErrors(['cantidad_vendida' => 'No hay suficiente stock']);
        }

        $inventario->decrement('cantidad', $request->cantidad_vendida);

        Venta::create($request->all());

        return redirect()->route('ventas')->with('success', 'Venta registrada');
    }
}