@extends('layouts.app')

@section('title', 'Detalles del Pedido')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h2"><i class="bi bi-receipt-cutoff"></i> Detalles del Pedido #{{ $pedido->id }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pedidos.index') }}">Pedidos</a></li>
                    <li class="breadcrumb-item active">Pedido #{{ $pedido->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Información del Pedido -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Productos del Pedido</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio Unit.</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->detalles as $detalle)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($detalle->producto->imagen)
                                                    <img src="{{ asset('storage/' . $detalle->producto->imagen) }}" 
                                                         alt="{{ $detalle->producto->nombre }}" 
                                                         width="50" 
                                                         class="rounded me-2">
                                                @endif
                                                <div>
                                                    <strong>{{ $detalle->producto->nombre }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td><strong>${{ number_format($detalle->subtotal, 2) }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong class="text-primary fs-5">${{ number_format($pedido->total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($pedido->notas)
                        <div class="alert alert-info mt-3">
                            <strong><i class="bi bi-info-circle"></i> Notas del Pedido:</strong>
                            <p class="mb-0 mt-2">{{ $pedido->notas }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Información del Cliente y Estado -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Información del Cliente</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong><br>{{ $pedido->user->name }}</p>
                    <p><strong>Email:</strong><br>{{ $pedido->user->email }}</p>
                    <p><strong>Fecha del Pedido:</strong><br>{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Estado del Pedido</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        @if($pedido->estado == 'pendiente')
                            <span class="badge bg-warning text-dark fs-6">Pendiente</span>
                        @elseif($pedido->estado == 'procesando')
                            <span class="badge bg-info fs-6">Procesando</span>
                        @elseif($pedido->estado == 'enviado')
                            <span class="badge bg-primary fs-6">Enviado</span>
                        @elseif($pedido->estado == 'entregado')
                            <span class="badge bg-success fs-6">Entregado</span>
                        @else
                            <span class="badge bg-danger fs-6">Cancelado</span>
                        @endif
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.pedidos.edit', $pedido) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Cambiar Estado
                        </a>
                        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Volver a Pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection