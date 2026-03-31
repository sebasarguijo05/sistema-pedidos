@extends('layouts.app')

@section('title', 'Gestión de Pedidos')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h2"><i class="bi bi-receipt"></i> Gestión de Pedidos</h1>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.pedidos.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Filtrar por Estado</label>
                        <select name="estado" id="estado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="procesando" {{ request('estado') == 'procesando' ? 'selected' : '' }}>Procesando</option>
                            <option value="enviado" {{ request('estado') == 'enviado' ? 'selected' : '' }}>Enviado</option>
                            <option value="entregado" {{ request('estado') == 'entregado' ? 'selected' : '' }}>Entregado</option>
                            <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Pedidos -->
    <div class="card">
        <div class="card-body">
            @if($pedidos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Productos</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td><strong>#{{ $pedido->id }}</strong></td>
                                    <td>
                                        {{ $pedido->user->name }}
                                        <br>
                                        <small class="text-muted">{{ $pedido->user->email }}</small>
                                    </td>
                                    <td><strong>HNL {{ number_format($pedido->total, 2) }}</strong></td>
                                    <td>
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
                                    </td>
                                    <td>{{ $pedido->detalles->count() }} producto(s)</td>
                                    <td>
                                        {{ $pedido->created_at->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ $pedido->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pedidos.show', $pedido) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="Ver Detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.pedidos.edit', $pedido) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.pedidos.destroy', $pedido) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este pedido?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $pedidos->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-receipt text-muted" style="font-size: 4rem;"></i>
                    <p class="text-muted mt-3">No hay pedidos registrados</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection