<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 dark:bg-green-900/30 p-3 rounded-md">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 text-sm text-red-600 bg-red-100 dark:bg-red-900/30 p-3 rounded-md">{{ session('error') }}</div>
            @endif

            <!-- Hero Banner ExtremeTech -->
            <div class="mb-8 rounded-xl overflow-hidden relative shadow-lg group">
                <img src="https://images.unsplash.com/photo-1624696941338-934bf86ce783?q=80&w=1200&h=400&fit=crop" alt="Promo Hero" class="w-full h-64 object-cover transform group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/70 to-transparent flex flex-col justify-center px-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight mb-2">Descubre <span class="text-extremetech">El Poder</span></h2>
                    <p class="text-gray-300 text-lg max-w-md mb-4">La nueva generación de tarjetas gráficas y componentes ya está aquí.</p>
                    <a href="#" class="inline-block bg-extremetech text-white px-6 py-2 uppercase font-bold text-sm tracking-wider w-max hover:bg-orange-600 transition">Ver Ofertas</a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4 mb-6">
                <form action="{{ route('productos.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[180px]">
                        <label class="block text-xs text-gray-500 mb-1">Buscar por nombre</label>
                        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Ej: audifonos" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                    </div>
                    <div class="min-w-[160px]">
                        <label class="block text-xs text-gray-500 mb-1">Categoria</label>
                        <select name="categoria_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                            <option value="">Todas</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="min-w-[140px]">
                        <label class="block text-xs text-gray-500 mb-1">Precio maximo</label>
                        <input type="number" name="precio_max" value="{{ request('precio_max') }}" placeholder="Ej: 30000" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-sm">
                    </div>
                    <button type="submit" class="px-6 py-2 bg-extremetech text-white font-bold uppercase tracking-wider text-sm hover:bg-orange-600 transition">Filtrar</button>
                    <a href="{{ route('productos.index') }}" class="text-sm text-gray-500 hover:underline">Limpiar</a>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($productos as $producto)
                    <a href="{{ route('productos.show', $producto) }}" class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden group hover:border-extremetech transition duration-300 flex flex-col">
                        <div class="relative overflow-hidden">
                            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-500">
                            <div class="absolute top-2 right-2 bg-extremetech text-white text-xs font-bold px-2 py-1 uppercase rounded-sm shadow-md">Nuevo</div>
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <p class="text-xs text-extremetech font-bold uppercase mb-1">{{ $producto->categoria->nombre }}</p>
                            <h3 class="font-bold text-gray-800 dark:text-gray-100 flex-1 group-hover:text-extremetech transition">{{ $producto->nombre }}</h3>
                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-lg font-black text-gray-900 dark:text-white">₡{{ number_format($producto->precio, 2) }}</p>
                                <span class="bg-gray-200 dark:bg-gray-700 p-2 rounded-full text-gray-600 dark:text-gray-300 group-hover:bg-extremetech group-hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="col-span-4 text-center text-gray-500 py-10">No se encontraron productos con esos filtros.</p>
                @endforelse
            </div>

            @if ($productosVistos->isNotEmpty())
                <div class="mt-10">
                    <h3 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">Vistos recientemente</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                        @foreach ($productosVistos as $producto)
                            <a href="{{ route('productos.show', $producto) }}" class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden hover:shadow-md transition">
                                <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" class="w-full h-24 object-cover">
                                <div class="p-2">
                                    <p class="text-xs text-gray-700 dark:text-gray-200 truncate">{{ $producto->nombre }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
