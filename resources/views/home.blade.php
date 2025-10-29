@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <i data-lucide="package" class="text-primary me-3" style="width: 40px; height: 40px;"></i>
                <div>
                    <h5 class="mb-0">{{ $totalProductos }}</h5>
                    <small class="text-muted">Productos</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <i data-lucide="dollar-sign" class="text-success me-3" style="width: 40px; height: 40px;"></i>
                <div>
                    <h5 class="mb-0">{{ number_format($totalVentas, 2) }}</h5>
                    <small class="text-muted">Ventas Totales</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <i data-lucide="trending-up" class="text-info me-3" style="width: 40px; height: 40px;"></i>
                <div>
                    <h5 class="mb-0">{{ number_format($ingresos, 2) }}</h5>
                    <small class="text-muted">Ingresos</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <i data-lucide="trending-down" class="{{ $balance >= 0 ? 'text-success' : 'text-danger' }} me-3" style="width: 40px; height: 40px;"></i>
                <div>
                    <h5 class="mb-0 {{ $balance >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($balance, 2) }}</h5>
                    <small class="text-muted">Balance</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Ventas Últimos 7 Días</h5>
                <button id="export-pdf" class="btn btn-sm btn-outline-primary">
                    <i data-lucide="download"></i> PDF
                </button>
            </div>
            <div class="card-body">
                <canvas id="ventasChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h5>Actividad Reciente</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($actividad as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->descripcion }}</span>
                            <small class="text-muted">{{ $item->fecha }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Sin actividad</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('ventasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($ultimos7dias),
            datasets: [{
                label: 'Ventas',
                data: @json($ventasPorDia),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } }
        }
    });

    document.getElementById('export-pdf').addEventListener('click', () => {
        import('dom-to-image').then(domToImage => {
            import('jspdf').then(jsPDF => {
                domToImage.default.toPng(document.querySelector('.card')).then(dataUrl => {
                    const pdf = new jsPDF.default();
                    pdf.addImage(dataUrl, 'PNG', 10, 10, 180, 0);
                    pdf.save('reporte_ventas.pdf');
                });
            });
        });
    });
</script>
@endsection