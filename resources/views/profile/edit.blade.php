<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-2">Historial de pedidos</h3>
                    <p class="text-sm text-gray-500 mb-3">Revisa las compras que has realizado en la tienda.</p>
                    <a href="{{ route('pedidos.index') }}" class="text-indigo-600 hover:underline text-sm">Ver mis pedidos &rarr;</a>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-2">Reportes de ventas (PDF)</h3>
                    <p class="text-sm text-gray-500 mb-3">Reportes generales de ventas de toda la tienda.</p>
                    <div class="flex gap-4 text-sm">
                        <a href="{{ route('reportes.porMes') }}" target="_blank" class="text-indigo-600 hover:underline">Ventas por mes</a>
                        <a href="{{ route('reportes.porCliente') }}" target="_blank" class="text-indigo-600 hover:underline">Ventas por cliente</a>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
