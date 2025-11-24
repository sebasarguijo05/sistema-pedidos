<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoUsuarioController extends Controller
{
    public function index()
    {
        $pedidos = auth()->user()->pedidos()
            ->with('detalles.producto')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        // Verificar que el pedido pertenece al usuario
        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }

        $pedido->load('detalles.producto');
        return view('pedidos.show', compact('pedido'));
    }

    public function crear(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('catalogo.index')
                ->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            // Crear el pedido
            $pedido = Pedido::create([
                'user_id' => auth()->id(),
                'total' => 0,
                'estado' => 'pendiente',
                'notas' => $request->notas,
            ]);

            // Crear los detalles del pedido
            foreach ($carrito as $id => $item) {
                $producto = Producto::find($id);

                if (!$producto || $producto->stock < $item['cantidad']) {
                    throw new \Exception('Stock insuficiente para ' . $item['nombre']);
                }

                $subtotal = $producto->precio * $item['cantidad'];
                $total += $subtotal;

                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio,
                    'subtotal' => $subtotal,
                ]);

                // Actualizar stock
                $producto->decrement('stock', $item['cantidad']);
            }

            // Actualizar total del pedido
            $pedido->update(['total' => $total]);

            // Vaciar carrito
            session()->forget('carrito');

            DB::commit();

            return redirect()->route('pedidos.show', $pedido)
                ->with('success', 'Pedido realizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}