<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        DB::table('categorias')->insert([
            ['nombre' => 'Componentes PC', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Periféricos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Monitores', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Laptops', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
