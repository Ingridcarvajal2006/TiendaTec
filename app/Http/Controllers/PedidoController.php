<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())->latest()->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function show(Pedido $pedido)
    {
        if ($pedido->user_id !== Auth::id()) {
            abort(403);
        }

        $pedido->load('detalles.producto');

        return view('pedidos.show', compact('pedido'));
    }
}
