@extends('layouts.app')

@section('title', 'Finanzas')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Finanzas</h5>
        <a href="{{ route('resumen') }}" class="btn btn-light btn-sm">Resumen</a>
    </div>
    <div class="card-body">
        <form method="POST" action="/finanzas" class="mb-4">
            @csrf
            <div class="row g-3">
                <div class="col-md-2">
                    <select name="tipo" class="form-select" required>
                        <option value="ingreso">Ingreso</option>
                        <option value="egreso">Egreso</option>
                    </select>
                </div>
                <div class="col-md-2"><input name="monto" type="number" step="0.01" class="form-control" placeholder="Monto" required></div>
                <div class="col-md-3"><input name="fecha" type="date" class="form-control" required></div>
                <div class="col-md-3"><input name="descripcion" class="form-control" placeholder="Descripción" required></div>
                <div class="col-md-2"><button type="submit" class="btn btn-success w-100">Guardar</button></div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finanzas as $item)
                        <tr class="{{ $item->tipo == 'ingreso' ? 'table-success' : 'table-danger' }}">
                            <td><strong>{{ ucfirst($item->tipo) }}</strong></td>
                            <td>{{ number_format($item->monto, 2) }}</td>
                            <td>{{ $item->fecha }}</td>
                            <td>{{ $item->descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection