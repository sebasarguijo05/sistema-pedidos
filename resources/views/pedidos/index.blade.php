@extends('layouts.app')

@section('title', 'Mis Pedidos')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h2"><i class="bi bi-bag-check"></i> Mis Pedidos</h1>
            <p class="text-muted">Historial de tus pedidos realizados</p>
        </div>
    </div>

    @if($pedidos->count() > 0)
        <div class="row">
            @foreach($pedidos as $pedido)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5 class="mb-1">Pedido #{{ $pedido->id }}</h5>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> 
                                                {{ $pedido->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <div>
                                            @if($pedido->estado == 'pendiente')
                                                <span class="badge bg-warning text-dark">Pendiente</span>
                                            @elseif($pedido->estado == 'procesando')
                                                <span class="badge bg-info">Procesando</span>
                                            @elseif($pedido->estado == 'enviado')
                                                <span class="badge bg-primary">Enviado</span>
                                            @elseif($pedido->estado == 'entregado')
                                                <span class="badge bg-success">Entregado</span>
                                            @else
                                                <span class="badge bg-danger">Cancelado</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Productos:</strong>
                                        <ul class="list-unstyled mt-2">
                                            @foreach($pedido->detalles->take(3) as $detalle)
                                                <li class="text-muted">
                                                    <i class="bi bi-box"></i> 
                                                    {{ $detalle->producto->nombre }} 
                                                    (x{{ $detalle->cantidad }})
                                                </li>
                                            @endforeach
                                            @if($pedido->detalles->count() > 3)
                                                <li class="text-muted">
                                                    <i class="bi bi-three-dots"></i> 
                                                    y {{ $pedido->detalles->count() - 3 }} producto(s) más
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-4 text-end d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="text-muted mb-1">Total del Pedido</p>
                                        <h3 class="text-primary mb-3">HNL {{ number_format($pedido->total, 2) }}</h3>
                                    </div>
                                    <div>
                                        <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-outline-primary">
                                            <i class="bi bi-eye"></i> Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @if($pedido->notas)
                                <div class="alert alert-light mt-3 mb-0">
                                    <small>
                                        <strong><i class="bi bi-chat-left-text"></i> Notas:</strong> 
                                        {{ $pedido->notas }}
                                    </small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $pedidos->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x text-muted" style="font-size: 5rem;"></i>
            <h3 class="mt-3">No tienes pedidos realizados</h3>
            <p class="text-muted">Comienza a explorar nuestro catálogo y realiza tu primer pedido</p>
            <a href="{{ route('catalogo.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-grid"></i> Ir al Catálogo
            </a>
        </div>
    @endif
</div>
@endsection