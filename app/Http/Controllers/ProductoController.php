<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('categoria');

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        $productos = $query->orderBy('nombre')->get();
        $categorias = Categoria::all();

        // Leer cookie de productos vistos recientemente
        $idsVistos = json_decode($request->cookie('productos_vistos', '[]'), true) ?? [];
        $productosVistos = Producto::whereIn('id', $idsVistos)->get()
            ->sortBy(fn ($p) => array_search($p->id, $idsVistos))
            ->values();

        return view('productos.index', compact('productos', 'categorias', 'productosVistos'));
    }

    public function show(Request $request, Producto $producto)
    {
        // Actualizar la cookie de "vistos recientemente"
        $idsVistos = json_decode($request->cookie('productos_vistos', '[]'), true) ?? [];
        $idsVistos = array_map('intval', $idsVistos);
        $idsVistos = array_values(array_diff($idsVistos, [$producto->id]));
        array_unshift($idsVistos, $producto->id);
        $idsVistos = array_slice($idsVistos, 0, 6);

        $cookie = cookie('productos_vistos', json_encode($idsVistos), 60 * 24 * 30);

        return response()
            ->view('productos.show', compact('producto'))
            ->cookie($cookie);
    }
}
