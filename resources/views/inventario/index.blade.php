@extends('layouts.app')

@section('title', 'Inventario')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Inventario</h5>
        <a href="{{ route('resumen') }}" class="btn btn-light btn-sm">Resumen</a>
    </div>
    <div class="card-body">
        <form method="POST" action="/inventario" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-3"><input name="producto_nombre" class="form-control" placeholder="Producto" required></div>
                <div class="col-md-2"><input name="cantidad" type="number" class="form-control" placeholder="Cant." required></div>
                <div class="col-md-2"><input name="precio" type="number" step="0.01" class="form-control" placeholder="Precio" required></div>
                <div class="col-md-3"><input name="fecha_actualizacion" type="date" class="form-control" required></div>
                <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Guardar</button></div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventarios as $item)
                        <tr>
                            <td>{{ $item->producto_nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>{{ number_format($item->precio, 2) }}</td>
                            <td>{{ $item->fecha_actualizacion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection