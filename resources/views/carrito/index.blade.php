@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h2"><i class="bi bi-cart3"></i> Carrito de Compras</h1>
        </div>
    </div>

    @if(!empty($carrito) && count($carrito) > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($carrito as $id => $item)
                            <div class="row mb-3 pb-3 border-bottom">
                                <div class="col-md-2">
                                    @if($item['imagen'])
                                        <img src="{{ asset('storage/' . $item['imagen']) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $item['nombre'] }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="height: 80px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h5>{{ $item['nombre'] }}</h5>
                                    <p class="text-muted mb-0">HNL {{ number_format($item['precio'], 2) }} c/u</p>
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('carrito.actualizar', $id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <input type="number" 
                                                   name="cantidad" 
                                                   value="{{ $item['cantidad'] }}" 
                                                   min="1" 
                                                   class="form-control"
                                                   onchange="this.form.submit()">
                                            <span class="input-group-text">uds</span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2 text-end">
                                    <p class="fw-bold fs-5 mb-2">
                                        ${{ number_format($item['precio'] * $item['cantidad'], 2) }}
                                    </p>
                                    <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-end mt-4">
                            <form action="{{ route('carrito.vaciar') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Vaciar el carrito?')">
                                    <i class="bi bi-trash"></i> Vaciar Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Resumen del Pedido</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>HNL {{ number_format($total, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-primary fs-4">HNL {{ number_format($total, 2) }}</strong>
                        </div>

                        <form action="{{ route('pedidos.crear') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="notas" class="form-label">Notas del Pedido (Opcional)</label>
                                <textarea class="form-control" 
                                          id="notas" 
                                          name="notas" 
                                          rows="3" 
                                          placeholder="Instrucciones especiales..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg">
                                <i class="bi bi-check-circle"></i> Confirmar Pedido
                            </button>
                        </form>

                        <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="bi bi-arrow-left"></i> Seguir Comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x text-muted" style="font-size: 5rem;"></i>
            <h3 class="mt-3">Tu carrito está vacío</h3>
            <p class="text-muted">Agrega productos desde nuestro catálogo</p>
            <a href="{{ route('catalogo.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-grid"></i> Ir al Catálogo
            </a>
        </div>
    @endif
</div>
@endsection