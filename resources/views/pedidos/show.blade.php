<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('pedidos.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Volver a mis pedidos</a>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mt-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Pedido confirmado</h2>
                <p class="text-sm text-gray-500 mb-4">Numero de seguimiento: <strong>{{ $pedido->numero_seguimiento }}</strong></p>

                <div class="text-sm text-gray-700 dark:text-gray-200 space-y-1 mb-4">
                    <div>Fecha de compra: {{ $pedido->fecha_compra }}</div>
                    <div>Metodo de pago: {{ $pedido->metodo_pago }}</div>
                    <div>Estado: {{ $pedido->estado }}</div>
                </div>

                <table class="min-w-full text-sm text-left mb-4">
                    <thead class="text-gray-500 uppercase text-xs border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="py-2">Producto</th>
                            <th class="py-2">Cantidad</th>
                            <th class="py-2">Precio unitario</th>
                            <th class="py-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($pedido->detalles as $detalle)
                            <tr>
                                <td class="py-2 text-gray-800 dark:text-gray-100">{{ $detalle->producto->nombre }}</td>
                                <td class="py-2 text-gray-800 dark:text-gray-100">{{ $detalle->cantidad }}</td>
                                <td class="py-2 text-gray-800 dark:text-gray-100">${{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="py-2 text-gray-800 dark:text-gray-100">${{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-sm text-gray-700 dark:text-gray-200 space-y-1 max-w-xs ml-auto">
                    <div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($pedido->subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>Impuestos</span><span>${{ number_format($pedido->impuestos, 2) }}</span></div>
                    <div class="flex justify-between"><span>Envio</span><span>${{ number_format($pedido->costo_envio, 2) }}</span></div>
                    <div class="flex justify-between font-semibold border-t border-gray-200 dark:border-gray-700 pt-2 mt-2">
                        <span>Total</span><span>${{ number_format($pedido->monto_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
