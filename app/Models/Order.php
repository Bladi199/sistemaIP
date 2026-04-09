<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'fecha_pedido',
        'fecha_entrega',
        'estado',
        'total',
        'descuento',
        'observaciones',
    ];

    // 🔗 RELACIONES

    // Pedido pertenece a cliente
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Pedido pertenece a usuario (vendedor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pedido tiene muchos detalles
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
    use HasFactory;
}