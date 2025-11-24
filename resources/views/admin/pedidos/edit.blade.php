@extends('layouts.app')

@section('title', 'Editar Pedido')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h2"><i class="bi bi-pencil"></i> Editar Pedido #{{ $pedido->id }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pedidos.index') }}">Pedidos</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.pedidos.update', $pedido) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label"><strong>Cliente:</strong></label>
                            <p>{{ $pedido->user->name }} ({{ $pedido->user->email }})</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Total del Pedido:</strong></label>
                            <p class="text-primary fs-5">${{ number_format($pedido->total, 2) }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado del Pedido *</label>
                            <select name="estado" 
                                    id="estado" 
                                    class="form-select @error('estado') is-invalid @enderror" 
                                    required>
                                <option value="pendiente" {{ old('estado', $pedido->estado) == 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>
                                <option value="procesando" {{ old('estado', $pedido->estado) == 'procesando' ? 'selected' : '' }}>
                                    Procesando
                                </option>
                                <option value="enviado" {{ old('estado', $pedido->estado) == 'enviado' ? 'selected' : '' }}>
                                    Enviado
                                </option>
                                <option value="entregado" {{ old('estado', $pedido->estado) == 'entregado' ? 'selected' : '' }}>
                                    Entregado
                                </option>
                                <option value="cancelado" {{ old('estado', $pedido->estado) == 'cancelado' ? 'selected' : '' }}>
                                    Cancelado
                                </option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notas" class="form-label">Notas Adicionales</label>
                            <textarea class="form-control @error('notas') is-invalid @enderror" 
                                      id="notas" 
                                      name="notas" 
                                      rows="4">{{ old('notas', $pedido->notas) }}</textarea>
                            @error('notas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Notas internas sobre el pedido</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Actualizar Pedido
                            </button>
                            <a href="{{ route('admin.pedidos.show', $pedido) }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Resumen de productos -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Productos en este Pedido</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($pedido->detalles as $detalle)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <strong>{{ $detalle->producto->nombre }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Cantidad: {{ $detalle->cantidad }} × ${{ number_format($detalle->precio_unitario, 2) }}
                                    </small>
                                </div>
                                <span class="badge bg-primary rounded-pill">
                                    ${{ number_format($detalle->subtotal, 2) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection