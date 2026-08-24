<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;

class CarritoController extends Controller
{
    // El carrito vive en la sesion como: ['producto_id' => cantidad, ...]

    public function index()
    {
        $carrito = session('carrito', []);
        $items = [];
        $subtotal = 0;

        foreach ($carrito as $productoId => $cantidad) {
            $producto = Producto::find($productoId);
            if (! $producto) {
                continue;
            }
            $totalLinea = $producto->precio * $cantidad;
            $subtotal += $totalLinea;
            $items[] = [
                'producto' => $producto,
                'cantidad' => $cantidad,
                'total_linea' => $totalLinea,
            ];
        }

        $impuestos = round($subtotal * 0.13, 2);
        $costoEnvio = $subtotal > 0 ? 2500 : 0;
        $total = $subtotal + $impuestos + $costoEnvio;

        return view('carrito.index', compact('items', 'subtotal', 'impuestos', 'costoEnvio', 'total'));
    }

    public function agregar(Request $request, Producto $producto)
    {
        $cantidad = max(1, (int) $request->input('cantidad', 1));

        $carrito = session('carrito', []);
        $carrito[$producto->id] = ($carrito[$producto->id] ?? 0) + $cantidad;
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')->with('success', 'Producto agregado al carrito.');
    }

    public function actualizar(Request $request, Producto $producto)
    {
        $cantidad = max(1, (int) $request->input('cantidad', 1));

        $carrito = session('carrito', []);
        $carrito[$producto->id] = $cantidad;
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }

    public function eliminar(Producto $producto)
    {
        $carrito = session('carrito', []);
        unset($carrito[$producto->id]);
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
