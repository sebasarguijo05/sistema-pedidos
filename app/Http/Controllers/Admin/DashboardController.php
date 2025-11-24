<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetallePedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de usuarios registrados
        $totalUsuarios = User::where('role', 'usuario')->count();
        
        // Total de productos
        $totalProductos = Producto::count();
        
        // Total de pedidos activos (no entregados ni cancelados)
        $pedidosActivos = Pedido::whereNotIn('estado', ['entregado', 'cancelado'])->count();
        
        // Total de pedidos
        $totalPedidos = Pedido::count();
        
        // Últimos pedidos
        $ultimosPedidos = Pedido::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Productos más vendidos
        $productosMasVendidos = DetallePedido::select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->with('producto')
            ->groupBy('producto_id')
            ->orderBy('total_vendido', 'desc')
            ->limit(5)
            ->get();
        
        // Últimos usuarios registrados
        $ultimosUsuarios = User::where('role', 'usuario')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalProductos',
            'pedidosActivos',
            'totalPedidos',
            'ultimosPedidos',
            'productosMasVendidos',
            'ultimosUsuarios'
        ));
    }
}