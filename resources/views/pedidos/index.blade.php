<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Mis pedidos</h2>

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Numero de seguimiento</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Metodo de pago</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Estado</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $pedido)
                            <tr class="border-t border-gray-100 dark:border-gray-700">
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $pedido->numero_seguimiento }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $pedido->fecha_compra }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $pedido->metodo_pago }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">${{ number_format($pedido->monto_total, 2) }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $pedido->estado }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('pedidos.show', $pedido) }}" class="text-indigo-600 hover:underline">Ver detalle</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Aun no has realizado ninguna compra.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
