<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'warehouse_id',
        'code',
        'name',
        'stock_actual',
        'stock_minimo',
        'stock_maximo',
        'precio_unitario',
        'status',
    ];

    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con almacén
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Relación con movimientos
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    // Relación con alertas
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}

