@extends('layouts.app')

@section('title', 'Dashboard Administrativo')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h2"><i class="bi bi-speedometer2"></i> Dashboard Administrativo</h1>
            <p class="text-muted">Resumen general del sistema</p>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Usuarios Registrados</h6>
                            <h2 class="mb-0">{{ $totalUsuarios }}</h2>
                        </div>
                        <div class="text-primary">
                            <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Productos</h6>
                            <h2 class="mb-0">{{ $totalProductos }}</h2>
                        </div>
                        <div class="text-success">
                            <i class="bi bi-box-seam-fill" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pedidos Activos</h6>
                            <h2 class="mb-0">{{ $pedidosActivos }}</h2>
                        </div>
                        <div class="text-warning">
                            <i class="bi bi-clock-fill" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Pedidos</h6>
                            <h2 class="mb-0">{{ $totalPedidos }}</h2>
                        </div>
                        <div class="text-info">
                            <i class="bi bi-receipt-cutoff" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accesos Rápidos -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-lightning-fill"></i> Accesos Rápidos</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.productos.index') }}" class="btn btn-outline-primary w-100 p-3">
                                <i class="bi bi-box-seam fs-3 d-block mb-2"></i>
                                <strong>Gestionar Productos</strong>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.productos.create') }}" class="btn btn-outline-success w-100 p-3">
                                <i class="bi bi-plus-circle fs-3 d-block mb-2"></i>
                                <strong>Agregar Producto</strong>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-outline-info w-100 p-3">
                                <i class="bi bi-receipt fs-3 d-block mb-2"></i>
                                <strong>Ver Todos los Pedidos</strong>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.pedidos.index', ['estado' => 'pendiente']) }}" class="btn btn-outline-warning w-100 p-3">
                                <i class="bi bi-hourglass-split fs-3 d-block mb-2"></i>
                                <strong>Pedidos Pendientes</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Últimos Pedidos -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-receipt"></i> Últimos Pedidos Realizados</h5>
                </div>
                <div class="card-body">
                    @if($ultimosPedidos->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ultimosPedidos as $pedido)
                                        <tr>
                                            <td><strong>#{{ $pedido->id }}</strong></td>
                                            <td>{{ $pedido->user->name }}</td>
                                            <td>HNL {{ number_format($pedido->total, 2) }}</td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.pedidos.index') }}" class="btn btn-sm btn-outline-primary">
                            Ver todos los pedidos <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <p class="text-muted text-center mb-0">No hay pedidos registrados</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Productos Más Vendidos -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up"></i> Productos Más Vendidos</h5>
                </div>
                <div class="card-body">
                    @if($productosMasVendidos->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($productosMasVendidos as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <strong>{{ $item->producto->nombre }}</strong>
                                        <br>
                                        <small class="text-muted">HNL {{ number_format($item->producto->precio, 2) }}</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $item->total_vendido }} vendidos
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted text-center mb-0">No hay datos de ventas</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Últimos Usuarios Registrados -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person-plus"></i> Últimos Usuarios Registrados</h5>
                </div>
                <div class="card-body">
                    @if($ultimosUsuarios->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha de Registro</th>
                                        <th>Pedidos Realizados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ultimosUsuarios as $usuario)
                                        <tr>
                                            <td><strong>{{ $usuario->name }}</strong></td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $usuario->pedidos->count() }} pedido(s)
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">No hay usuarios registrados</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection