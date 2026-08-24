<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #222; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        p.subtitle { color: #666; margin-top: 0; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de ventas por cliente</h1>
    <p class="subtitle">TiendaTec — Generado el {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Correo</th>
                <th>Cantidad de pedidos</th>
                <th>Total comprado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventasPorCliente as $fila)
                <tr>
                    <td>{{ $fila->user->name ?? 'N/A' }}</td>
                    <td>{{ $fila->user->email ?? 'N/A' }}</td>
                    <td>{{ $fila->cantidad_pedidos }}</td>
                    <td>${{ number_format($fila->total_comprado, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay ventas registradas todavia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
