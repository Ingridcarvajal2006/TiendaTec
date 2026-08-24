<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Confirmar compra</h2>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-4">
                <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">Resumen del pedido</h3>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($items as $item)
                        <div class="flex justify-between py-2 text-sm text-gray-700 dark:text-gray-200">
                            <span>{{ $item['producto']->nombre }} x{{ $item['cantidad'] }}</span>
                            <span>${{ number_format($item['total_linea'], 2) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                    <div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>Impuestos (13%)</span><span>${{ number_format($impuestos, 2) }}</span></div>
                    <div class="flex justify-between"><span>Envio</span><span>${{ number_format($costoEnvio, 2) }}</span></div>
                    <div class="flex justify-between font-semibold border-t border-gray-200 dark:border-gray-700 pt-2 mt-2">
                        <span>Total a pagar</span><span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">Metodo de pago</h3>
                <p class="text-xs text-gray-500 mb-4">
                    Esta es una pasarela de pago simulada para fines academicos: no se procesan pagos reales ni se guardan datos de tarjetas.
                </p>

                <form action="{{ route('checkout.procesar') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Correo para recibo -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Correo para el Recibo</h4>
                        <input type="email" name="email_recibo" value="{{ Auth::user()->email }}" required placeholder="ejemplo@correo.com" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                        <p class="text-xs text-gray-500 mt-1">A este correo enviaremos el comprobante de pago en PDF.</p>
                    </div>
                    
                    <!-- Dirección de Envío -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Dirección de Envío</h4>
                        <textarea name="direccion_envio" rows="3" required placeholder="Ej: San José, Montes de Oca, 100m este de la UCR. Casa amarilla." class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm"></textarea>
                    </div>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="metodo_pago" value="Tarjeta de credito" checked>
                            Tarjeta de credito
                        </label>
                        <label class="flex items-center gap-2 text-sm">
                            <input type="radio" name="metodo_pago" value="PayPal">
                            PayPal
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-xs text-gray-500 mb-1">Numero de tarjeta (simulado)</label>
                            <input type="text" placeholder="4242 4242 4242 4242" maxlength="19" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Vencimiento</label>
                            <input type="text" placeholder="MM/AA" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">CVV</label>
                            <input type="text" placeholder="123" maxlength="4" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                        </div>
                    </div>

                    <x-primary-button>{{ __('Confirmar y pagar') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
