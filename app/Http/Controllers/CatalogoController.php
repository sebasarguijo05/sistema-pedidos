<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::where('activo', true);

        if ($request->has('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $productos = $query->orderBy('nombre')->paginate(12);

        return view('catalogo.index', compact('productos'));
    }

    public function show(Producto $producto)
    {
        return view('catalogo.show', compact('producto'));
    }
}