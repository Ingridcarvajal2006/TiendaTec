<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio', 10, 2);
            $table->string('imagen_url')->nullable();
            $table->json('especificaciones')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        DB::table('productos')->insert([
            [
                'categoria_id' => 1,
                'nombre' => 'NVIDIA GeForce RTX 4090 24GB',
                'descripcion' => 'La GPU definitiva para gaming y creación de contenido. Arquitectura Ada Lovelace.',
                'precio' => 1250000,
                'imagen_url' => 'https://images.unsplash.com/photo-1591488320449-011701bb6704?q=80&w=400',
                'especificaciones' => json_encode(['Memoria' => '24 GB GDDR6X', 'Núcleos CUDA' => '16384', 'Reloj Base' => '2.23 GHz', 'Consumo' => '450W', 'Puertos' => '3x DP, 1x HDMI']),
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 1,
                'nombre' => 'Procesador Intel Core i9-14900K',
                'descripcion' => '24 núcleos (8 P-cores + 16 E-cores), hasta 6.0 GHz. Rendimiento extremo.',
                'precio' => 450000,
                'imagen_url' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?q=80&w=400',
                'especificaciones' => json_encode(['Núcleos' => '24 (8P+16E)', 'Hilos' => '32', 'Frecuencia Turbo' => '6.0 GHz', 'Zócalo' => 'LGA 1700', 'TDP' => '125W']),
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 1,
                'nombre' => 'Corsair Vengeance RGB 32GB DDR5',
                'descripcion' => 'Memoria RAM DDR5 6000MHz (2x16GB) con iluminación RGB dinámica.',
                'precio' => 115000,
                'imagen_url' => 'https://images.unsplash.com/photo-1562976540-1502c2145186?q=80&w=400',
                'especificaciones' => json_encode(['Capacidad' => '32GB (2x16GB)', 'Tipo' => 'DDR5', 'Velocidad' => '6000 MHz', 'Latencia' => 'CL36', 'Iluminación' => 'RGB Direccionable']),
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Teclado Mecánico Corsair K70 RGB',
                'descripcion' => 'Switches Cherry MX Red, chasis de aluminio, iluminación RGB por tecla.',
                'precio' => 95000,
                'imagen_url' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?q=80&w=400',
                'especificaciones' => json_encode(['Interruptores' => 'Cherry MX Red', 'Tamaño' => 'Full Size (100%)', 'Material' => 'Aluminio cepillado', 'Conexión' => 'USB 3.0', 'Anti-Ghosting' => '100% NKRO']),
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Mouse Logitech G Pro X Superlight',
                'descripcion' => 'Ratón inalámbrico ultraligero diseñado para esports profesionales.',
                'precio' => 85000,
                'imagen_url' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c3c9c?q=80&w=400',
                'especificaciones' => json_encode(['Peso' => '< 63 gramos', 'Sensor' => 'HERO 25K', 'DPI' => '100 - 25,600', 'Batería' => 'Hasta 70 horas', 'Botones' => '5 Programables']),
                'stock' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 2,
                'nombre' => 'Audífonos HyperX Cloud II Wireless',
                'descripcion' => 'Sonido envolvente 7.1, comodidad legendaria, conexión inalámbrica 2.4GHz.',
                'precio' => 105000,
                'imagen_url' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?q=80&w=400',
                'especificaciones' => json_encode(['Conexión' => 'Inalámbrica 2.4 GHz', 'Batería' => 'Hasta 30 horas', 'Sonido' => '7.1 Virtual Surround', 'Micrófono' => 'Desmontable con cancelación de ruido', 'Controladores' => '53mm']),
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 3,
                'nombre' => 'Monitor ASUS ROG Swift 27" 1440p',
                'descripcion' => 'Panel IPS de 27 pulgadas, resolución WQHD, tasa de refresco 240Hz, 1ms.',
                'precio' => 480000,
                'imagen_url' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?q=80&w=400',
                'especificaciones' => json_encode(['Resolución' => '2560x1440 (WQHD)', 'Tasa de Refresco' => '240Hz', 'Tiempo de Respuesta' => '1ms (GTG)', 'Panel' => 'Fast IPS', 'HDR' => 'DisplayHDR 400']),
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 3,
                'nombre' => 'Monitor LG UltraGear 34" Ultrawide',
                'descripcion' => 'Monitor curvo Ultrawide (21:9) 144Hz, compatible con G-Sync.',
                'precio' => 550000,
                'imagen_url' => 'https://images.unsplash.com/photo-1552831388-6a0b3575b32a?q=80&w=400',
                'especificaciones' => json_encode(['Resolución' => '3440x1440p (UWQHD)', 'Relación' => '21:9 Ultrawide', 'Tasa de Refresco' => '144Hz (160Hz OC)', 'Curvatura' => '1900R', 'G-Sync' => 'Compatible']),
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 4,
                'nombre' => 'Laptop ASUS ROG Zephyrus G14',
                'descripcion' => 'Ryzen 9, RTX 4060, 16GB RAM, pantalla Anime Matrix.',
                'precio' => 980000,
                'imagen_url' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?q=80&w=400',
                'especificaciones' => json_encode(['Procesador' => 'AMD Ryzen 9 7940HS', 'Gráficos' => 'NVIDIA RTX 4060 8GB', 'RAM' => '16GB DDR5', 'Almacenamiento' => '1TB PCIe 4.0 NVMe', 'Pantalla' => '14" QHD+ 165Hz ROG Nebula']),
                'stock' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'categoria_id' => 4,
                'nombre' => 'Laptop MSI Stealth 16 Studio',
                'descripcion' => 'Intel Core i7 13.ª gen, RTX 4070, 32GB RAM, 1TB NVMe, pantalla QHD+ 240Hz.',
                'precio' => 1150000,
                'imagen_url' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?q=80&w=400',
                'especificaciones' => json_encode(['Procesador' => 'Intel Core i7-13700H', 'Gráficos' => 'NVIDIA RTX 4070 8GB', 'RAM' => '32GB DDR5', 'Almacenamiento' => '1TB NVMe Gen4', 'Chasis' => 'Aleación de Magnesio-Aluminio']),
                'stock' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
