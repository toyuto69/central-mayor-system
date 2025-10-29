<?php

namespace App\Http\Controllers;

use App\Models\Finanza;
use Illuminate\Http\Request;

class FinanzaController extends Controller
{
    public function index()
    {
        $finanzas = Finanza::latest()->get();
        return view('finanzas.index', compact('finanzas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:ingreso,egreso',
            'monto' => 'required|numeric|min:0.01',
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
        ]);

        Finanza::create($request->all());

        return redirect()->route('finanzas')->with('success', 'Movimiento registrado');
    }
}