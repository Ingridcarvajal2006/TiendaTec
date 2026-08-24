<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Carrito de compras</h2>

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Producto</th>
                            <th class="px-4 py-3">Precio</th>
                            <th class="px-4 py-3">Cantidad</th>
                            <th class="px-4 py-3">Subtotal</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr class="border-t border-gray-100 dark:border-gray-700">
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $item['producto']->nombre }}</td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">${{ number_format($item['producto']->precio, 2) }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('carrito.actualizar', $item['producto']) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="w-16 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                                        <button type="submit" class="text-xs text-indigo-600 hover:underline">Actualizar</button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-gray-800 dark:text-gray-100">${{ number_format($item['total_linea'], 2) }}</td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('carrito.eliminar', $item['producto']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-xs">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Tu carrito esta vacio. <a href="{{ route('productos.index') }}" class="text-indigo-600 hover:underline">Ver productos</a></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (count($items) > 0)
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mt-4 max-w-sm ml-auto text-sm text-gray-700 dark:text-gray-200 space-y-1">
                    <div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>Impuestos (13%)</span><span>${{ number_format($impuestos, 2) }}</span></div>
                    <div class="flex justify-between"><span>Envio</span><span>${{ number_format($costoEnvio, 2) }}</span></div>
                    <div class="flex justify-between font-semibold border-t border-gray-200 dark:border-gray-700 pt-2 mt-2">
                        <span>Total</span><span>${{ number_format($total, 2) }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block text-center mt-4 px-4 py-2 bg-gray-900 dark:bg-gray-700 text-white rounded-md">Proceder al pago</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
