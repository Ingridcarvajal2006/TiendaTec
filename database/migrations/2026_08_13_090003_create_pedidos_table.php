<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('fecha_compra');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impuestos', 10, 2);
            $table->decimal('costo_envio', 10, 2);
            $table->decimal('monto_total', 10, 2);
            $table->string('metodo_pago');
            $table->string('numero_seguimiento')->unique();
            $table->string('estado')->default('Confirmado');
            $table->text('direccion_envio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
