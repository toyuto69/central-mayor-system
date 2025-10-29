@extends('layouts.app')

@section('title', 'Resumen General')

@section('content')
<div class="row g-4">
    <!-- Inventario -->
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Productos en Inventario</h5>
                <h2 class="display-5 fw-bold">{{ $totalProductos }}</h2>
                <p class="mb-0">Artículos registrados</p>
            </div>
        </div>
    </div>

    <!-- Ventas Totales -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Ventas Totales</h5>
                <h2 class="display-5 fw-bold">{{ number_format($totalVentas, 2) }}</h2>
                <p class="mb-0">Ingresos generados</p>
            </div>
        </div>
    </div>

    <!-- Balance Financiero -->
    <div class="col-md-4">
        <div class="card text-white {{ $balance >= 0 ? 'bg-info' : 'bg-danger' }} shadow-sm">
            <div class="card-body text-center">
                <h5 class="card-title">Balance Financiero</h5>
                <h2 class="display-5 fw-bold">{{ number_format($balance, 2) }}</h2>
                <p class="mb-0">{{ $balance >= 0 ? 'Ganancia' : 'Pérdida' }}</p>
            </div>
        </div>
    </div>
</div>

<hr class="my-5">

<h4 class="mb-4">Últimas Movimientos</h4>
<div class="row">
    <div class="col-md-6">
        <h6>Últimas Ventas</h6>
        <ul class="list-group">
            @forelse($ultimasVentas as $venta)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $venta->inventario->producto_nombre ?? 'N/A' }}</span>
                    <span class="text-success">{{ number_format($venta->total, 2) }}</span>
                </li>
            @empty
                <li class="list-group-item text-muted">No hay ventas recientes</li>
            @endforelse
        </ul>
    </div>
    <div class="col-md-6">
        <h6>Últimos Movimientos Financieros</h6>
        <ul class="list-group">
            @forelse($ultimosMovimientos as $mov)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $mov->descripcion }}</span>
                    <span class="{{ $mov->tipo == 'ingreso' ? 'text-success' : 'text-danger' }}">
                        {{ $mov->tipo == 'ingreso' ? '+' : '-' }}{{ number_format($mov->monto, 2) }}
                    </span>
                </li>
            @empty
                <li class="list-group-item text-muted">No hay movimientos recientes</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection