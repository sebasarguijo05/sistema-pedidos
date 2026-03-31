@extends('layouts.app')

@section('title', 'Detalle del Pedido')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Mis Pedidos</a></li>
            <li class="breadcrumb-item active">Pedido #{{ $pedido->id }}</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1"><i class="bi bi-receipt-cutoff"></i> Pedido #{{ $pedido->id }}</h1>
                    <p class="text-muted mb-0">
                        <i class="bi bi-calendar"></i> Realizado el {{ $pedido->created_at->format('d/m/Y') }} 
                        a las {{ $pedido->created_at->format('H:i') }}
                    </p>
                </div>
                <div>
                    @if($pedido->estado == 'pendiente')
                        <span class="badge bg-warning text-dark fs-5">Pendiente</span>
                    @elseif($pedido->estado == 'procesando')
                        <span class="badge bg-info fs-5">Procesando</span>
                    @elseif($pedido->estado == 'enviado')
                        <span class="badge bg-primary fs-5">Enviado</span>
                    @elseif($pedido->estado == 'entregado')
                        <span class="badge bg-success fs-5">Entregado</span>
                    @else
                        <span class="badge bg-danger fs-5">Cancelado</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Estado del Pedido (Timeline) -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="bi bi-clock-history"></i> Estado del Pedido</h5>
                    <div class="d-flex justify-content-between">
                        <div class="text-center {{ $pedido->estado == 'pendiente' || $pedido->estado == 'procesando' || $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'text-success' : 'text-muted' }}">
                            <div class="mb-2">
                                <i class="bi bi-check-circle-fill fs-2"></i>
                            </div>
                            <small class="fw-bold">Pendiente</small>
                        </div>
                        <div class="flex-grow-1 align-self-center">
                            <hr class="{{ $pedido->estado == 'procesando' || $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'border-success' : '' }}" style="height: 2px;">
                        </div>
                        <div class="text-center {{ $pedido->estado == 'procesando' || $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'text-success' : 'text-muted' }}">
                            <div class="mb-2">
                                <i class="bi {{ $pedido->estado == 'procesando' || $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'bi-check-circle-fill' : 'bi-circle' }} fs-2"></i>
                            </div>
                            <small class="fw-bold">Procesando</small>
                        </div>
                        <div class="flex-grow-1 align-self-center">
                            <hr class="{{ $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'border-success' : '' }}" style="height: 2px;">
                        </div>
                        <div class="text-center {{ $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'text-success' : 'text-muted' }}">
                            <div class="mb-2">
                                <i class="bi {{ $pedido->estado == 'enviado' || $pedido->estado == 'entregado' ? 'bi-check-circle-fill' : 'bi-circle' }} fs-2"></i>
                            </div>
                            <small class="fw-bold">Enviado</small>
                        </div>
                        <div class="flex-grow-1 align-self-center">
                            <hr class="{{ $pedido->estado == 'entregado' ? 'border-success' : '' }}" style="height: 2px;">
                        </div>
                        <div class="text-center {{ $pedido->estado == 'entregado' ? 'text-success' : 'text-muted' }}">
                            <div class="mb-2">
                                <i class="bi {{ $pedido->estado == 'entregado' ? 'bi-check-circle-fill' : 'bi-circle' }} fs-2"></i>
                            </div>
                            <small class="fw-bold">Entregado</small>
                        </div>
                    </div>

                    @if($pedido->estado == 'cancelado')
                        <div class="alert alert-danger mt-3 mb-0">
                            <i class="bi bi-exclamation-triangle"></i> 
                            <strong>Este pedido ha sido cancelado</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Productos del Pedido -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-box-seam"></i> Productos del Pedido</h5>
                </div>
                <div class="card-body">
                    @foreach($pedido->detalles as $detalle)
                        <div class="row mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="col-md-2">
                                @if($detalle->producto->imagen)
                                    <img src="{{ asset('storage/' . $detalle->producto->imagen) }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $detalle->producto->nombre }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="height: 80px;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-1">{{ $detalle->producto->nombre }}</h6>
                                <p class="text-muted mb-0">
                                    <small>Precio unitario: ${{ number_format($detalle->precio_unitario, 2) }}</small>
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <p class="mb-0">Cantidad</p>
                                <strong class="fs-5">{{ $detalle->cantidad }}</strong>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="mb-0 text-muted">Subtotal</p>
                                <strong class="text-primary fs-5">HNL {{ number_format($detalle->subtotal, 2) }}</strong>
                            </div>
                        </div>
                    @endforeach

                    <div class="row mt-4 pt-3 border-top">
                        <div class="col-md-8 offset-md-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span>HNL {{ number_format($pedido->total, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong class="fs-5">Total:</strong>
                                <strong class="text-primary fs-3">HNL {{ number_format($pedido->total, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Información del Pedido</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Fecha:</strong><br>
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="mb-2">
                        <strong>Estado:</strong><br>
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
                    </p>
                    <p class="mb-0">
                        <strong>Total de Productos:</strong><br>
                        {{ $pedido->detalles->count() }} producto(s)
                    </p>
                </div>
            </div>

            @if($pedido->notas)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-chat-left-text"></i> Notas del Pedido</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $pedido->notas }}</p>
                    </div>
                </div>
            @endif

            <a href="{{ route('pedidos.index') }}" class="btn btn-outline-primary w-100 mb-2">
                <i class="bi bi-arrow-left"></i> Volver a Mis Pedidos
            </a>

            <a href="{{ route('catalogo.index') }}" class="btn btn-primary w-100">
                <i class="bi bi-grid"></i> Seguir Comprando
            </a>
        </div>
    </div>
</div>
@endsection