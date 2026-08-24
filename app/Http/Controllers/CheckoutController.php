<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoConfirmadoMail;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito esta vacio.');
        }

        $items = [];
        $subtotal = 0;

        foreach ($carrito as $productoId => $cantidad) {
            $producto = Producto::find($productoId);
            if (! $producto) {
                continue;
            }
            $totalLinea = $producto->precio * $cantidad;
            $subtotal += $totalLinea;
            $items[] = ['producto' => $producto, 'cantidad' => $cantidad, 'total_linea' => $totalLinea];
        }

        $impuestos = round($subtotal * 0.13, 2);
        $costoEnvio = $subtotal > 0 ? 2500 : 0;
        $total = $subtotal + $impuestos + $costoEnvio;

        return view('checkout.index', compact('items', 'subtotal', 'impuestos', 'costoEnvio', 'total'));
    }

    public function procesar(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required|in:Tarjeta de credito,PayPal',
            'direccion_envio' => 'required|string',
            'email_recibo' => 'required|email',
        ]);

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito esta vacio.');
        }

        $pedido = DB::transaction(function () use ($carrito, $request) {
            $subtotal = 0;
            $lineas = [];

            foreach ($carrito as $productoId => $cantidad) {
                $producto = Producto::find($productoId);
                if (! $producto) {
                    continue;
                }
                $subtotal += $producto->precio * $cantidad;
                $lineas[] = ['producto' => $producto, 'cantidad' => $cantidad];
            }

            $impuestos = round($subtotal * 0.13, 2);
            $costoEnvio = $subtotal > 0 ? 2500 : 0;
            $total = $subtotal + $impuestos + $costoEnvio;

            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'fecha_compra' => now()->toDateString(),
                'subtotal' => $subtotal,
                'impuestos' => $impuestos,
                'costo_envio' => $costoEnvio,
                'monto_total' => $total,
                'metodo_pago' => $request->metodo_pago,
                // "pasarela de pago" simulada: en un caso real aqui se llamaria a Stripe/PayPal.
                'numero_seguimiento' => 'TT-' . strtoupper(Str::random(8)),
                'estado' => 'Confirmado',
                'direccion_envio' => $request->direccion_envio,
            ]);

            foreach ($lineas as $linea) {
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $linea['producto']->id,
                    'cantidad' => $linea['cantidad'],
                    'precio_unitario' => $linea['producto']->precio,
                ]);
            }

            return $pedido;
        });

        session()->forget('carrito');

        // Generar PDF y enviar correo
        $pdf = Pdf::loadView('emails.pedido_pdf', ['pedido' => $pedido]);
        $pdfContent = $pdf->output();

        Mail::to($request->email_recibo)->send(new PedidoConfirmadoMail($pedido, $pdfContent));

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Compra confirmada. El comprobante de pago se ha enviado a tu correo electrónico.');
    }
}
