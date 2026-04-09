<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Customer extends Model
{
    protected $fillable = [
        'name',
        'razon_social',
        'nit',
        'telefono',
        'direccion',
    ];

    // 🔗 RELACIONES

    // Un cliente tiene muchos pedidos
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}