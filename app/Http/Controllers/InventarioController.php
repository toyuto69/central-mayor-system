<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::all();
        return view('inventario.index', compact('inventarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'fecha_actualizacion' => 'required|date'
        ]);

        Inventario::create([
            'producto_nombre' => $request->producto_nombre,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'fecha_actualizacion' => $request->fecha_actualizacion
        ]);

        return redirect()->back()->with('success', 'Producto agregado correctamente');
    }
}
