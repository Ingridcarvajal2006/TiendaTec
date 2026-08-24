<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'precio',
        'imagen_url',
        'stock',
        'especificaciones',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'especificaciones' => 'array',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
