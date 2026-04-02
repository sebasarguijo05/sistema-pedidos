@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2"><i class="bi bi-grid"></i> Catálogo de Productos</h1>
            <p class="text-muted">Explora nuestros productos disponibles</p>
        </div>
        <div class="col-md-4">
            <form action="{{ route('catalogo.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="buscar"
                           class="form-control"
                           placeholder="Buscar productos..."
                           value="{{ request('buscar') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($productos->count() > 0)
        <div class="row g-4">
            @foreach($productos as $producto)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                 class="card-img-top"
                                 alt="{{ $producto->nombre }}"
                                 style="height: 250px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 250px;">
                                <i class="bi bi-image text-muted" style="font-size: 4rem;"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($producto->descripcion, 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary fs-4 fw-bold">
                                    HNL {{ number_format($producto->precio, 2) }}
                                </span>
                                @if($producto->stock > 0)
                                    <span class="badge bg-success">
                                        Stock: {{ $producto->stock }}
                                    </span>
                                @else
                                    <span class="badge bg-danger">Agotado</span>
                                @endif
                            </div>

                            @if($producto->stock > 0)
                                <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-2">
                                        <input type="number"
                                               name="cantidad"
                                               value="1"
                                               min="1"
                                               max="{{ $producto->stock }}"
                                               class="form-control">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-cart-plus"></i> Agregar
                                        </button>
                                    </div>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    <i class="bi bi-x-circle"></i> No Disponible
                                </button>
                            @endif

                            <a href="{{ route('catalogo.show', $producto) }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-eye"></i> Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $productos->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
            <p class="text-muted mt-3">No se encontraron productos</p>
            @if(request('buscar'))
                <a href="{{ route('catalogo.index') }}" class="btn btn-primary">
                    Ver todos los productos
                </a>
            @endif
        </div>
    @endif
</div>
@endsection
