<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo de Pedido {{ $pedido->numero_seguimiento }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { color: #ff6600; margin-bottom: 0; }
        .info { margin-bottom: 30px; }
        .info p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #f9f9f9; }
        .total-row td { font-weight: bold; border-top: 2px solid #333; }
        .footer { text-align: center; color: #777; font-size: 12px; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>EXTREMETECH</h1>
        <p>Recibo de Compra</p>
    </div>

    <div class="info">
        <p><strong>Pedido #:</strong> {{ $pedido->numero_seguimiento }}</p>
        <p><strong>Fecha:</strong> {{ $pedido->fecha_compra }}</p>
        <p><strong>Cliente:</strong> {{ $pedido->user->name }} ({{ $pedido->user->email }})</p>
        <p><strong>Dirección de Envío:</strong> {{ $pedido->direccion_envio }}</p>
        <p><strong>Método de Pago:</strong> {{ $pedido->metodo_pago }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $detalle)
            <tr>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>₡{{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>₡{{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Subtotal:</td>
                <td>₡{{ number_format($pedido->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">Impuestos (13%):</td>
                <td>₡{{ number_format($pedido->impuestos, 2) }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">Envío:</td>
                <td>₡{{ number_format($pedido->costo_envio, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align: right; color: #ff6600;">Total Pagado:</td>
                <td style="color: #ff6600;">₡{{ number_format($pedido->monto_total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Gracias por confiar en ExtremeTech Costa Rica.</p>
        <p>Este documento es un comprobante de pago generado electrónicamente.</p>
    </div>
</body>
</html>
