<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fecha_compra',
        'subtotal',
        'impuestos',
        'costo_envio',
        'monto_total',
        'metodo_pago',
        'numero_seguimiento',
        'estado',
        'direccion_envio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
