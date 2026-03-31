@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('catalogo.index') }}">Catálogo</a></li>
            <li class="breadcrumb-item active">{{ $producto->nombre }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                     class="img-fluid rounded shadow" 
                     alt="{{ $producto->nombre }}">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center rounded shadow" 
                     style="height: 400px;">
                    <i class="bi bi-image text-muted" style="font-size: 8rem;"></i>
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <h1 class="h2 mb-3">{{ $producto->nombre }}</h1>
            
            <div class="mb-3">
                @if($producto->stock > 0)
                    <span class="badge bg-success fs-6">
                        <i class="bi bi-check-circle"></i> Disponible ({{ $producto->stock }} en stock)
                    </span>
                @else
                    <span class="badge bg-danger fs-6">
                        <i class="bi bi-x-circle"></i> Agotado
                    </span>
                @endif
            </div>

            <div class="mb-4">
                <span class="text-primary display-5 fw-bold">HNL {{ number_format($producto->precio, 2) }}</span>
            </div>

            <div class="mb-4">
                <h5>Descripción</h5>
                <p class="text-muted">
                    {{ $producto->descripcion ?? 'No hay descripción disponible para este producto.' }}
                </p>
            </div>

            @if($producto->stock > 0)
                <div class="card bg-light">
                    <div class="card-body">
                        <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" 
                                           id="cantidad"
                                           name="cantidad" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $producto->stock }}" 
                                           class="form-control form-control-lg">
                                </div>
                                <div class="col-md-8 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Este producto está agotado actualmente.
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Volver al Catálogo
                </a>
            </div>
        </div>
    </div>
</div>
@endsection