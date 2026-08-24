<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function porMes()
    {
        $ventasPorMes = Pedido::selectRaw("strftime('%Y-%m', fecha_compra) as mes, COUNT(*) as cantidad_pedidos, SUM(monto_total) as total_vendido")
            ->groupBy('mes')
            ->orderBy('mes', 'desc')
            ->get();

        $pdf = Pdf::loadView('reportes.por_mes', compact('ventasPorMes'));

        return $pdf->stream('reporte-ventas-por-mes.pdf');
    }

    public function porCliente()
    {
        $ventasPorCliente = Pedido::with('user')
            ->selectRaw('user_id, COUNT(*) as cantidad_pedidos, SUM(monto_total) as total_comprado')
            ->groupBy('user_id')
            ->orderByDesc('total_comprado')
            ->get();

        $pdf = Pdf::loadView('reportes.por_cliente', compact('ventasPorCliente'));

        return $pdf->stream('reporte-ventas-por-cliente.pdf');
    }
}
