@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h2"><i class="bi bi-box-seam"></i> Gestión de Productos</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nuevo Producto
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if ($productos->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                    <tr>
                                        <td>
                                            @if ($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}"
                                                    alt="{{ $producto->nombre }}" width="50" class="rounded">
                                            @else
                                                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $producto->nombre }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($producto->descripcion, 50) }}</small>
                                        </td>
                                        <td>HNL {{ number_format($producto->precio, 2) }}</td>
                                        <td>
                                            @if ($producto->stock > 10)
                                                <span class="badge bg-success">{{ $producto->stock }}</span>
                                            @elseif($producto->stock > 0)
                                                <span class="badge bg-warning">{{ $producto->stock }}</span>
                                            @else
                                                <span class="badge bg-danger">Agotado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($producto->activo)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-secondary">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.productos.edit', $producto) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
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
                        {{ $productos->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-box-seam text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3">No hay productos registrados</p>
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">
                            Crear Primer Producto
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
