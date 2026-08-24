<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('productos.index') }}" class="text-sm text-gray-500 hover:underline">&larr; Volver al catalogo</a>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mt-4 md:flex">
                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full md:w-72 h-64 object-cover">
                <div class="p-6 flex-1">
                    <p class="text-xs text-gray-400 uppercase">{{ $producto->categoria->nombre }}</p>
                    <h2 class="text-3xl font-black text-gray-800 dark:text-gray-100 uppercase">{{ $producto->nombre }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-4">{{ $producto->descripcion }}</p>
                    <p class="text-4xl font-black text-extremetech mt-6">₡{{ number_format($producto->precio, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1 mb-6">Stock disponible: {{ $producto->stock }}</p>

                    @if($producto->especificaciones)
                        <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4 uppercase">Especificaciones Técnicas</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($producto->especificaciones as $key => $value)
                                    <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg border border-gray-100 dark:border-gray-700">
                                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold">{{ $key }}</p>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $value }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @auth
                        <form action="{{ route('carrito.agregar', $producto) }}" method="POST" class="mt-4 flex items-end gap-3">
                            @csrf
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Cantidad</label>
                                <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock }}" class="w-24 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                            </div>
                            <button type="submit" class="px-6 py-2 bg-extremetech text-white font-bold uppercase tracking-wider text-sm hover:bg-orange-600 transition shadow-lg shadow-orange-500/30">Agregar al carrito</button>
                        </form>
                    @else
                        <p class="mt-4 text-sm text-gray-500">
                            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Inicia sesion</a> para agregar este producto al carrito.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
