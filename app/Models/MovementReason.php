<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementReason extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'affects_stock',
        'description',
    ];

    // Relación: un motivo puede usarse en muchos movimientos
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
