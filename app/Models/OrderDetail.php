<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // 🔗 RELACIONES

    // Detalle pertenece a pedido
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Detalle pertenece a producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
}