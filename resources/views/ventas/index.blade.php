@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Ventas</h5>
        <a href="{{ route('resumen') }}" class="btn btn-light btn-sm">Resumen</a>
    </div>
    <div class="card-body">
        <form method="POST" action="/ventas" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <select name="producto_id" class="form-select" required>
                        <option value="">Seleccionar producto</option>
                        @foreach(\App\Models\Inventario::all() as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->producto_nombre }} ({{ $producto->cantidad }} en stock)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2"><input name="cantidad_vendida" type="number" class="form-control" placeholder="Cant." required></div>
                <div class="col-md-2"><input name="total" type="number" step="0.01" class="form-control" placeholder="Total" required></div>
                <div class="col-md-2"><input name="fecha_venta" type="date" class="form-control" required></div>
                <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Registrar Venta</button></div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cant. Vendida</th>
                        <th>Total</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->inventario->producto_nombre ?? 'Producto eliminado' }}</td>
                            <td>{{ $venta->cantidad_vendida }}</td>
                            <td>{{ number_format($venta->total, 2) }}</td>
                            <td>{{ $venta->fecha_venta }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection